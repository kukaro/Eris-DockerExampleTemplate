<?php


namespace App\Http\Repositories\BookmarkCategories;


use App\Http\Domains\BookmarkCategory;
use App\Http\Dtos\MoveCategoriesInfo;

/**
 * Interface BookmarkCategoriesRepository
 * @package App\Http\Repositories\BookmarkCategories
 */
interface BookmarkCategoryRepository
{
    /**
     * @param int $office_no
     * @return array|null
     */
    public function loadOfficeCategoriesWithBookmarkCategories(int $office_no) : ?array;

    /**
     * @param int $office_no
     * @param int $office_user_no
     * @return array|null
     */
    public function loadOfficeUserCategoriesWithBookmarkCategories(int $office_no, int $office_user_no) : ?array;

    /**
     * @param int[] $category_no_list
     * @param int $office_no
     * @return array|null
     */
    public function loadOfficeCategoriesByCategoryNoList(array $category_no_list, int $office_no);

    /**
     * @param int[] $category_no_list
     * @param int $office_no
     * @param int $office_user_no
     * @return array|null
     */
    public function loadOfficeUserCategoriesByCategoryNoList(array $category_no_list, int $office_no, int $office_user_no);

    /**
     * @param int $bookmark_category_no
     * @param int $office_no
     * @return BookmarkCategory|null
     */
    public function loadOfficeCategoryBookmark(int $bookmark_category_no, int $office_no) : ?BookmarkCategory;

    /**
     * @param int $bookmark_category_no
     * @param int $office_no
     * @param int $office_user_no
     * @return BookmarkCategory|null
     */
    public function loadOfficeUserCategoryBookmark(int $bookmark_category_no, int $office_no, int $office_user_no) : ?BookmarkCategory;

    /**
     * @param int|null $parent_category_no
     * @param int $office_no
     * @param int|null $office_user_no
     * @return int
     */
    public function getBookmarkCategoryMaxOrderNo(?int $parent_category_no, int $office_no, int $office_user_no=null) : int;

    /**
     * @param BookmarkCategory $bookmark_category
     * @param int $office_no
     * @param int $office_user_no
     * @return int
     */
    public function createCategoryBookmark(BookmarkCategory $bookmark_category, int $office_no, int $office_user_no=null): int;

    /**
     * @param BookmarkCategory $bookmark_category
     * @param int $office_no
     * @param int|null $office_user_no
     * @return int
     */
    public function createCategory(BookmarkCategory $bookmark_category, int $office_no, int $office_user_no=null): int;

    /**
     * @param BookmarkCategory $bookmark_category
     */
    public function modifyBookmark(BookmarkCategory $bookmark_category): void;

    /**
     * @param BookmarkCategory $bookmark_category
     */
    public function modifyCategoryName(BookmarkCategory $bookmark_category) : void;

    /**
     * @param MoveCategoriesInfo $move_categories_info
     */
    public function moveCategory(MoveCategoriesInfo $move_categories_info) : void;

    /**
     * @param int $bookmark_category_no
     * @param int $office_no
     * @param int $office_user_no
     */
    public function deleteCategory(int $bookmark_category_no, int $office_no, ?int $office_user_no): void;

    /**
     * @param int $bookmark_category_no
     */
    public function changeCategoryToNoParent(int $bookmark_category_no) : void;

    /**
     * @param int $bookmark_category_no
     */
    public function deleteCategoryChild(int $bookmark_category_no): void;
}
