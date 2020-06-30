<?php


namespace App\Http\Repositories\BookmarkCategories;


use App\Http\Domains\BookmarkCategory;
use App\Http\Dtos\MoveCategoriesInfo;
use App\Models\Bookmark;
use App\Models\BookmarkCategory as BookmarkCategoryModel;
use Illuminate\Support\Facades\DB;
use JsonMapper;

class BookmarkCategoryRepositoryImpl implements BookmarkCategoryRepository
{
    /**
     * @var JsonMapper
     */
    private $json_mapper;

    /**
     * BookmarkCategoriesRepositoryImpl constructor.
     */
    public function __construct()
    {
        $this->json_mapper = new JsonMapper();
    }

    public function loadOfficeCategoriesWithBookmarkCategories(int $office_no): ?array
    {
        $bookmark_category = BookmarkCategoryModel::with(['bookmarkCategories', 'bookmark'])
            ->where('office_no', $office_no)
            ->where('is_del', 'n')
            ->whereNull('office_user_no')
            ->whereNull('parent_category_no')
            ->get()
        ;

        $mapped_bookmark_category = $this->json_mapper->mapArray(
            json_decode($bookmark_category->toJson()),
            [],
            BookmarkCategory::class
        );

        return $mapped_bookmark_category;
    }

    public function loadOfficeUserCategoriesWithBookmarkCategories(int $office_no, int $office_user_no): ?array
    {
        $bookmark_category = BookmarkCategoryModel::with(['bookmarkCategories', 'bookmark'])
            ->where('office_no', $office_no)
            ->where('office_user_no', $office_user_no)
            ->where('is_del', 'n')
            ->whereNull('parent_category_no')
            ->get()
        ;

        $mapped_bookmark_category = $this->json_mapper->mapArray(
            json_decode($bookmark_category->toJson()),
            [],
            BookmarkCategory::class
        );

        return $mapped_bookmark_category;
    }

    public function loadOfficeCategoriesByCategoryNoList(array $category_no_list, int $office_no)
    {
        $bookmark_category = BookmarkCategoryModel::with(['bookmarkCategories', 'bookmark'])
            ->whereIn('no', $category_no_list)
            ->where('office_no', $office_no)
            ->whereNull('office_user_no')
            ->get()
        ;

        $mapped_bookmark_category = $this->json_mapper->mapArray(
            json_decode($bookmark_category->toJson()),
            [],
            BookmarkCategory::class
        );

        return $mapped_bookmark_category;
    }

    public function loadOfficeUserCategoriesByCategoryNoList(array $category_no_list, int $office_no, int $office_user_no)
    {
        $bookmark_category = BookmarkCategoryModel::with(['bookmarkCategories', 'bookmark'])
            ->whereIn('no', $category_no_list)
            ->where('office_no', $office_no)
            ->where('office_user_no', $office_user_no)
            ->get()
        ;

        $mapped_bookmark_category = $this->json_mapper->mapArray(
            json_decode($bookmark_category->toJson()),
            [],
            BookmarkCategory::class
        );

        return $mapped_bookmark_category;
    }


    public function loadOfficeCategoryBookmark(int $bookmark_category_no, int $office_no): ?BookmarkCategory
    {
        $bookmark_category = BookmarkCategoryModel::with(['bookmark'])
            ->where('office_no', $office_no)
            ->where('is_del', 'n')
            ->whereNull('office_user_no')
            ->findOrFail($bookmark_category_no);

        if(empty($bookmark_category)){
            return null;
        }

        $mapped_bookmark_category = $this->json_mapper->map(
            json_decode($bookmark_category->toJson()),
            new BookmarkCategory()
        );

        return $mapped_bookmark_category;
    }

    public function loadOfficeUserCategoryBookmark(int $bookmark_category_no, int $office_no, int $office_user_no): ?BookmarkCategory
    {
        $bookmark_category = BookmarkCategoryModel::with(['bookmark'])
            ->where('office_no', $office_no)
            ->where('office_user_no', $office_user_no)
            ->where('is_del', 'n')
            ->find($bookmark_category_no);

        if(empty($bookmark_category)){
            return null;
        }

        $mapped_bookmark_category = $this->json_mapper->map(
            json_decode($bookmark_category->toJson()),
            new BookmarkCategory()
        );

        return $mapped_bookmark_category;
    }


    public function getBookmarkCategoryMaxOrderNo(?int $parent_category_no, int $office_no, int $office_user_no = null) : int
    {
        $max_order_no_query = BookmarkCategoryModel::query()
            ->where('office_no', $office_no)
            ->where('is_del', 'n')
        ;

        if(empty($parent_category_no))
        {
            $max_order_no_query->whereNull('parent_category_no');
        }
        else
        {
            $max_order_no_query->where('parent_category_no', $parent_category_no);
        }

        if(!empty($office_user_no))
        {
            $max_order_no_query->where('office_user_no', $office_user_no);
        }

        $max_order_no = $max_order_no_query->max('order_no');
        if(empty($max_order_no)){
            return 0;
        }
        return intval($max_order_no) + 1;
    }


    public function createCategoryBookmark(BookmarkCategory $bookmark_category,
                                           int $office_no,
                                           int $office_user_no = null): int
    {
        $bookmark_category_model = new BookmarkCategoryModel();
        $bookmark_category_model->order_no = $bookmark_category->getOrderNo();
        $bookmark_category_model->office_no = $office_no;
        $bookmark_category_model->is_del = 'n';
        if(!empty($bookmark_category->getParentCategoryNo())){
            $bookmark_category_model->parent_category_no = $bookmark_category->getParentCategoryNo();
        }
        if(!empty($office_user_no)){
            $bookmark_category_model->office_user_no = $office_user_no;
        }

        $bookmark_model = new Bookmark();
        $bookmark_model->url = $bookmark_category->getBookmark()->getUrl();
        $bookmark_model->name = $bookmark_category->getBookmark()->getName();
        $bookmark_model->description = $bookmark_category->getBookmark()->getDescription();

        $bookmark_category_model->save();
        $bookmark_model->bookmarkCategory()->associate($bookmark_category_model)->save();

        return $bookmark_category_model->no;
    }

    public function createCategory(BookmarkCategory $bookmark_category, int $office_no, int $office_user_no = null): int
    {
        $bookmark_category_model = new BookmarkCategoryModel();
        $bookmark_category_model->name = $bookmark_category->getName();
        $bookmark_category_model->order_no = $bookmark_category->getOrderNo();
        $bookmark_category_model->office_no = $office_no;
        $bookmark_category_model->is_del = 'n';
        if(!empty($bookmark_category->getParentCategoryNo())){
            $bookmark_category_model->parent_category_no = $bookmark_category->getParentCategoryNo();
        }
        if(!empty($office_user_no)){
            $bookmark_category_model->office_user_no = $office_user_no;
        }
        $bookmark_category_model->save();

        return $bookmark_category_model->no;
    }

    public function modifyBookmark(BookmarkCategory $bookmark_category): void
    {
        $bookmark_category_model = BookmarkCategoryModel::with(['bookmark'])
            ->findOrFail($bookmark_category->getNo());

        if( !$bookmark_category->getBookmark()->isUpdateCondition() )
        {
            return;
        }

        if(!empty($bookmark_category->getParentCategoryNo()))
        {
            $bookmark_category_model->update([
                'parent_category_no' => $bookmark_category->getParentCategoryNo()
            ]);
        }
        else
        {
            $bookmark_category_model->update([
                'parent_category_no' => null
            ]);
        }

        $update_bookmark = [];
        if(!empty($bookmark_category->getBookmark()->getName()))
        {
            $update_bookmark['name'] = $bookmark_category->getBookmark()->getName();
        }
        if(!empty($bookmark_category->getBookmark()->getUrl()))
        {
            $update_bookmark['url'] = $bookmark_category->getBookmark()->getUrl();
        }

        $bookmark_category_model->bookmark()->update($update_bookmark);

        $bookmark_category_model->save();
    }

    public function modifyCategoryName(BookmarkCategory $bookmark_category): void
    {
        $bookmark_category_model = BookmarkCategoryModel::query()
            ->findOrFail($bookmark_category->getNo());

        $bookmark_category_model->update([
            'name' => $bookmark_category->getName()
        ]);

        $bookmark_category_model->save();
    }

    public function moveCategory(MoveCategoriesInfo $move_categories_info): void
    {
        collect($move_categories_info->getOrder())->each(function(int $no, int $index) use ($move_categories_info){
            $parent_category_no = $move_categories_info->getNo();
            if(empty($parent_category_no))
            {
                $parent_category_no = null;
            }

            $bookmark_category_model = BookmarkCategoryModel::query()
                ->where('no', $no)
                ->where('is_del', 'n')
            ;

            $bookmark_category_model->update([
                'parent_category_no'=>$parent_category_no,
                'order_no' => $index
            ]);
        });
    }


    public function deleteCategory(int $bookmark_category_no, int $office_no, int $office_user_no=null): void
    {
        /**
         * update is_del
         */
        $bookmark_category_model = BookmarkCategoryModel::query()
            ->find($bookmark_category_no);

        $bookmark_category_model->update([
            'is_del' => 'y'
        ]);

        /**
         * update order_no
         */
        $parent_category_no = $bookmark_category_model->parent_category_no;
        $order_no = $bookmark_category_model->order_no;

        $order_update_bookmark_category_model = BookmarkCategoryModel::query()
            ->where('office_no' , $office_no)
            ->where('order_no', '>', $order_no)
            ->where('is_del', 'n')
        ;

        if(empty($office_user_no))
        {
            $order_update_bookmark_category_model->where('office_user_no',$office_user_no);
        }
        else
        {
            $order_update_bookmark_category_model->where('office_user_no',$office_user_no);
        }

        if(empty($parent_category_no))
        {
            $order_update_bookmark_category_model->whereNull('parent_category_no');
        }
        else
        {
            $order_update_bookmark_category_model->where('parent_category_no', $parent_category_no);
        }

        $order_update_bookmark_category_model->decrement('order_no');
    }

    public function changeCategoryToNoParent(int $bookmark_category_no): void
    {
        $bookmark_category = BookmarkCategoryModel::with(['bookmarkCategories'])
            ->findOrFail($bookmark_category_no);

        $bookmark_category->childBookmarkCategories()->update([
            'parent_category_no' => null
        ]);

        $bookmark_category->save();
    }

    public function deleteCategoryChild(int $bookmark_category_no): void
    {
        $bookmark_category = BookmarkCategoryModel::with(['bookmarkCategories'])
            ->findOrFail($bookmark_category_no);

        $bookmark_category->childBookmarkCategories()->update([
            'is_del' => 'y'
        ]);

        $bookmark_category->save();
    }


}
