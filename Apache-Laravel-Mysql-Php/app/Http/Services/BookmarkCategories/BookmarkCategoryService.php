<?php


namespace App\Http\Services\BookmarkCategories;


use App\Http\Domains\BookmarkCategory;
use App\Http\Dtos\DeleteBookmarkCategoryRequest;
use App\Http\Dtos\MoveCategoriesInfo;
use App\Http\Dtos\MoveCategoriesRequest;

/**
 * Interface BookmarkCategoryService
 * @package App\Http\Services\BookmarkCategories
 */
interface BookmarkCategoryService
{
    /**
     * @param int $office_no
     * @return array
     */
    public function loadOfficeCategoriesWithChildBookmarkCategories(int $office_no) : array;

    /**
     * @param int $office_no
     * @param int $office_user_no
     * @return array
     */
    public function loadOfficeUserCategoriesWithBookmarkCategories(int $office_no, int $office_user_no) : array;

    /**
     * @param BookmarkCategory $bookmark_category
     * @param int $office_no
     * @return BookmarkCategory
     */
    public function createOfficeCategoryBookmark(BookmarkCategory $bookmark_category, int $office_no) : BookmarkCategory;

    /**
     * @param BookmarkCategory $bookmark_category
     * @param int $office_no
     * @param int $office_user_no
     * @return BookmarkCategory
     */
    public function createOfficeUserCategoryBookmark(BookmarkCategory $bookmark_category, int $office_no, int $office_user_no) : BookmarkCategory;

    /**
     * @param BookmarkCategory $bookmark_category
     * @param int $office_no
     * @return BookmarkCategory
     */
    public function createOfficeCategory(BookmarkCategory $bookmark_category, int $office_no) : BookmarkCategory;

    /**
     * @param BookmarkCategory $bookmark_category
     * @param int $office_no
     * @param int $office_user_no
     * @return BookmarkCategory
     */
    public function createOfficeUserCategory(BookmarkCategory $bookmark_category, int $office_no, int $office_user_no) : BookmarkCategory;

    /**
     * @param BookmarkCategory $bookmark_category
     * @param int $office_no
     */
    public function modifyOfficeBookmark(BookmarkCategory $bookmark_category, int $office_no) : void;

    /**
     * @param BookmarkCategory $bookmark_category
     * @param int $office_no
     * @param int $office_user_no
     */
    public function modifyOfficeUserBookmarkNameAndUrl(BookmarkCategory $bookmark_category, int $office_no, int $office_user_no) : void;

    /**
     * @param BookmarkCategory $bookmark_category
     * @param int $office_no
     */
    public function modifyOfficeCategoryName(BookmarkCategory $bookmark_category, int $office_no) : void;

    /**
     * @param BookmarkCategory $bookmark_category
     * @param int $office_no
     * @param int $office_user_no
     */
    public function modifyOfficeUserCategoryName(BookmarkCategory $bookmark_category, int $office_no, int $office_user_no) : void;

    /**
     * @param MoveCategoriesRequest $move_categories_request
     * @param int $office_no
     */
    public function moveOfficeCategory(MoveCategoriesRequest $move_categories_request, int $office_no) : void;

    /**
     * @param MoveCategoriesInfo $move_categories_info
     * @param int $office_no
     * @param int $office_user_no
     */
    public function moveOfficeUserCategory(MoveCategoriesInfo $move_categories_info, int $office_no, int $office_user_no) : void;

    /**
     * @param DeleteBookmarkCategoryRequest $delete_bookmark_category_request
     * @param int $office_no
     */
    public function deleteOfficeCategory(DeleteBookmarkCategoryRequest $delete_bookmark_category_request, int $office_no) : void;

    /**
     * @param BookmarkCategory $bookmark_category
     * @param int $office_no
     * @param int $office_user_no
     */
    public function deleteOfficeUserCategory(BookmarkCategory $bookmark_category, int $office_no, int $office_user_no) : void;
}
