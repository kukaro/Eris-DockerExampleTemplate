<?php


namespace App\Http\Services\BookmarkCategories;


use App\Exceptions\NotOwnerException;
use App\Exceptions\NotOwnerListException;
use App\Http\Domains\BookmarkCategory;
use App\Http\Dtos\DeleteBookmarkCategoryRequest;
use App\Http\Dtos\MoveCategoriesInfo;
use App\Http\Dtos\MoveCategoriesRequest;
use App\Http\Repositories\BookmarkCategories\BookmarkCategoryRepository;

class BookmarkCategoryServiceImpl implements BookmarkCategoryService
{
    /**
     * @var BookmarkCategoryRepository
     */
    private $bookmark_category_repository;

    /**
     * BookmarkCategoryServiceImpl constructor.
     * @param BookmarkCategoryRepository $bookmark_category_repository
     */
    public function __construct(BookmarkCategoryRepository $bookmark_category_repository)
    {
        $this->bookmark_category_repository = $bookmark_category_repository;
    }

    public function loadOfficeCategoriesWithChildBookmarkCategories(int $office_no): array
    {
        return $this->bookmark_category_repository->loadOfficeCategoriesWithBookmarkCategories($office_no);
    }


    public function loadOfficeUserCategoriesWithBookmarkCategories(int $office_no, int $office_user_no): array
    {
        return $this->bookmark_category_repository->loadOfficeUserCategoriesWithBookmarkCategories($office_no, $office_user_no);
    }

    public function createOfficeCategoryBookmark(BookmarkCategory $bookmark_category, int $office_no): BookmarkCategory
    {
        $order_no = $this->bookmark_category_repository->getBookmarkCategoryMaxOrderNo(
            $bookmark_category->getParentCategoryNo(),
            $office_no
        );
        $bookmark_category->setOrderNo($order_no);

        $bookmark_categories_no = $this->bookmark_category_repository->createCategoryBookmark($bookmark_category, $office_no);

        return $this->bookmark_category_repository->loadOfficeCategoryBookmark(
            $bookmark_categories_no,
            $office_no
        );
    }

    public function createOfficeUserCategoryBookmark(BookmarkCategory $bookmark_category, int $office_no, int $office_user_no): BookmarkCategory
    {
        $order_no = $this->bookmark_category_repository->getBookmarkCategoryMaxOrderNo(
            $bookmark_category->getParentCategoryNo(),
            $office_no,
            $office_user_no
        );
        $bookmark_category->setOrderNo($order_no);

        $bookmark_categories_no = $this->bookmark_category_repository->createCategoryBookmark($bookmark_category, $office_no, $office_user_no);

        return $this->bookmark_category_repository->loadOfficeUserCategoryBookmark(
            $bookmark_categories_no,
            $office_no,
            $office_user_no
        );
    }

    public function createOfficeCategory(BookmarkCategory $bookmark_category, int $office_no): BookmarkCategory
    {
        $order_no = $this->bookmark_category_repository->getBookmarkCategoryMaxOrderNo(
            $bookmark_category->getParentCategoryNo(),
            $office_no
        );
        $bookmark_category->setOrderNo($order_no);
        $bookmark_categories_no = $this->bookmark_category_repository->createCategory($bookmark_category, $office_no);

        return $this->bookmark_category_repository->loadOfficeCategoryBookmark(
            $bookmark_categories_no,
            $office_no
        );
    }

    public function createOfficeUserCategory(BookmarkCategory $bookmark_category, int $office_no, int $office_user_no): BookmarkCategory
    {
        $order_no = $this->bookmark_category_repository->getBookmarkCategoryMaxOrderNo(
            $bookmark_category->getParentCategoryNo(),
            $office_no,
            $office_user_no
        );
        $bookmark_category->setOrderNo($order_no);
        $bookmark_categories_no = $this->bookmark_category_repository->createCategory($bookmark_category, $office_no, $office_user_no);

        return $this->bookmark_category_repository->loadOfficeUserCategoryBookmark(
            $bookmark_categories_no,
            $office_no,
            $office_user_no
        );
    }

    public function modifyOfficeBookmark(BookmarkCategory $bookmark_category, int $office_no): void
    {
        $loaded_bookmark_category = $this->bookmark_category_repository->loadOfficeCategoryBookmark(
            $bookmark_category->getNo(),
            $office_no
        );
        if(empty($loaded_bookmark_category))
        {
            throw new NotOwnerException($bookmark_category, $office_no);
        }

        $this->bookmark_category_repository->modifyBookmark($bookmark_category);
    }

    public function modifyOfficeUserBookmarkNameAndUrl(BookmarkCategory $bookmark_category, int $office_no, int $office_user_no): void
    {
        $loaded_bookmark_category = $this->bookmark_category_repository->loadOfficeUserCategoryBookmark(
            $bookmark_category->getNo(),
            $office_no,
            $office_user_no
        );

        if(empty($loaded_bookmark_category))
        {
            throw new NotOwnerException($bookmark_category, $office_no, $office_user_no);
        }

        $this->bookmark_category_repository->modifyBookmark($bookmark_category);
    }

    public function modifyOfficeCategoryName(BookmarkCategory $bookmark_category, int $office_no): void
    {
        $loaded_bookmark_category = $this->bookmark_category_repository->loadOfficeCategoryBookmark(
            $bookmark_category->getNo(),
            $office_no
        );
        if(empty($loaded_bookmark_category))
        {
            throw new NotOwnerException($bookmark_category, $office_no);
        }

        $this->bookmark_category_repository->modifyCategoryName($bookmark_category);
    }

    public function modifyOfficeUserCategoryName(BookmarkCategory $bookmark_category, int $office_no, int $office_user_no): void
    {
        $loaded_bookmark_category = $this->bookmark_category_repository->loadOfficeUserCategoryBookmark(
            $bookmark_category->getNo(),
            $office_no,
            $office_user_no
        );

        if(empty($loaded_bookmark_category))
        {
            throw new NotOwnerException($bookmark_category, $office_no);
        }

        $this->bookmark_category_repository->modifyCategoryName($bookmark_category);
    }

    public function moveOfficeCategory(MoveCategoriesRequest $move_categories_request, int $office_no): void
    {
        /**
         * validation
         */
        if($move_categories_request->isFromUpdateTarget()) {
            $from_bookmark_category = $this->bookmark_category_repository->loadOfficeCategoriesByCategoryNoList(
                $move_categories_request->getFrom()->getOrder(), $office_no
            );

            if (count($from_bookmark_category) != count($move_categories_request->getFrom()->getOrder())) {
                throw new NotOwnerListException($move_categories_request->getFrom()->getOrder(), $office_no);
            }
        }

        $to_bookmark_category = $this->bookmark_category_repository->loadOfficeCategoriesByCategoryNoList(
            $move_categories_request->getTo()->getOrder(), $office_no
        );

        if (count($to_bookmark_category) != count($move_categories_request->getTo()->getOrder())) {
            throw new NotOwnerListException($move_categories_request->getTo()->getOrder(), $office_no);
        }

        /**
         * update
         */
        if($move_categories_request->isFromUpdateTarget())
        {
            $this->bookmark_category_repository->moveCategory($move_categories_request->getFrom());
        }

        $this->bookmark_category_repository->moveCategory($move_categories_request->getTo());
    }

    public function moveOfficeUserCategory(MoveCategoriesInfo $move_categories_info, int $office_no, int $office_user_no): void
    {
        $bookmark_category = $this->bookmark_category_repository->loadOfficeUserCategoriesByCategoryNoList(
            $move_categories_info->getOrder(),$office_no,$office_user_no
        );

        if(count($bookmark_category) != count($move_categories_info->getOrder()))
        {
            throw new NotOwnerListException($move_categories_info->getOrder(), $office_no, $office_user_no);
        }
        $this->bookmark_category_repository->moveCategory($move_categories_info);
    }


    public function deleteOfficeCategory(DeleteBookmarkCategoryRequest $delete_bookmark_category_request, int $office_no): void
    {
        $loaded_bookmark_category = $this->bookmark_category_repository->loadOfficeCategoryBookmark(
            $delete_bookmark_category_request->getNo(),
            $office_no
        );

        if(empty($loaded_bookmark_category))
        {
            $bookmark_category = new BookmarkCategory();
            $bookmark_category->setNo($delete_bookmark_category_request->getNo());
            throw new NotOwnerException($bookmark_category, $office_no);
        }

        if($delete_bookmark_category_request->getIsDeleteChild())
        {
            $this->bookmark_category_repository->deleteCategoryChild($delete_bookmark_category_request->getNo());
        }
        else
        {
            $this->bookmark_category_repository->changeCategoryToNoParent($delete_bookmark_category_request->getNo());
        }

        $this->bookmark_category_repository->deleteCategory($delete_bookmark_category_request->getNo(), $office_no);
    }

    public function deleteOfficeUserCategory(BookmarkCategory $bookmark_category, int $office_no, int $office_user_no): void
    {
        $loaded_bookmark_category = $this->bookmark_category_repository->loadOfficeUserCategoryBookmark(
            $bookmark_category->getNo(),
            $office_no,
            $office_user_no
        );

        if(empty($loaded_bookmark_category))
        {
            throw new NotOwnerException($bookmark_category, $office_no);
        }

        $this->bookmark_category_repository->deleteCategory($bookmark_category->getNo(), $office_no, $office_user_no);
    }


}
