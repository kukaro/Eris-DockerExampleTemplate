<?php


namespace App\Http\Controllers;


use App\Http\Domains\BookmarkCategory;
use App\Http\Dtos\DeleteBookmarkCategoryRequest;
use App\Http\Dtos\MoveCategoriesInfo;
use App\Http\Dtos\MoveCategoriesRequest;
use App\Http\Services\BookmarkCategories\BookmarkCategoryService;
use Hiworks\Auth\Auth;

class CategoryController extends Controller
{
    /**
     * @var BookmarkCategoryService
     */
    private $bookmark_category_service;

    /**
     * CategoryController constructor.
     * @param BookmarkCategoryService $bookmark_category_service
     */
    public function __construct(BookmarkCategoryService $bookmark_category_service)
    {
        $this->bookmark_category_service = $bookmark_category_service;
    }


    public function loadOfficeCategories(Auth $auth)
    {
        $categories = $this->bookmark_category_service
            ->loadOfficeCategoriesWithChildBookmarkCategories($auth->getOfficeNo());

        return response()->jsonapi($categories, ['bookmark_categories','bookmark']);
    }

    public function loadOfficeUserCategories(Auth $auth)
    {
        $categories = $this->bookmark_category_service
            ->loadOfficeUserCategoriesWithBookmarkCategories($auth->getOfficeNo(), $auth->getOfficeUserNo());

        return response()->jsonapi($categories, ['bookmark_categories','bookmark']);
    }

    public function createOfficeCategoryBookmark(BookmarkCategory $bookmark_category, Auth $auth)
    {
        $bookmark_category = $this->bookmark_category_service->createOfficeCategoryBookmark($bookmark_category, $auth->getOfficeNo());

        return response()->jsonapi($bookmark_category, ['bookmark']);
    }

    public function createOfficeUserCategoryBookmark(BookmarkCategory $bookmark_category, Auth $auth)
    {
        $bookmark_category = $this->bookmark_category_service->createOfficeUserCategoryBookmark(
            $bookmark_category,
            $auth->getOfficeNo(),
            $auth->getOfficeUserNo()
        );

        return response()->jsonapi($bookmark_category, ['bookmark']);
    }

    public function createOfficeCategory(BookmarkCategory $bookmark_category, Auth $auth)
    {
        $bookmark_category = $this->bookmark_category_service->createOfficeCategory($bookmark_category, $auth->getOfficeNo());

        return response()->jsonapi($bookmark_category, ['bookmark']);
    }

    public function createOfficeUserCategory(BookmarkCategory $bookmark_category, Auth $auth)
    {
        $bookmark_category = $this->bookmark_category_service->createOfficeUserCategory(
            $bookmark_category,
            $auth->getOfficeNo(),
            $auth->getOfficeUserNo()
        );

        return response()->jsonapi($bookmark_category, ['bookmark']);
    }

    public function modifyOfficeBookmark(BookmarkCategory $bookmark_category, Auth $auth)
    {
        $this->bookmark_category_service->modifyOfficeBookmark(
            $bookmark_category,
            $auth->getOfficeNo()
        );

        return response('success');
    }

    public function modifyOfficeUserBookmarkNameAndUrl(BookmarkCategory $bookmark_category, Auth $auth)
    {
        $this->bookmark_category_service->modifyOfficeUserBookmarkNameAndUrl(
            $bookmark_category,
            $auth->getOfficeNo(),
            $auth->getOfficeUserNo()
        );

        return response('success');
    }

    public function modifyOfficeCategoryName(BookmarkCategory $bookmark_category, Auth $auth)
    {
        $this->bookmark_category_service->modifyOfficeCategoryName(
            $bookmark_category,
            $auth->getOfficeNo()
        );

        return response('success');
    }

    public function modifyOfficeUserCategoryName(BookmarkCategory $bookmark_category, Auth $auth)
    {
        $this->bookmark_category_service->modifyOfficeUserCategoryName(
            $bookmark_category,
            $auth->getOfficeNo(),
            $auth->getOfficeUserNo()
        );

        return response('success');
    }

    public function moveOfficeCategory(MoveCategoriesRequest $move_categories_request, Auth $auth)
    {
        $this->bookmark_category_service->moveOfficeCategory(
            $move_categories_request, $auth->getOfficeNo()
        );

        return response('success');
    }

    public function moveOfficeUserCategory(MoveCategoriesInfo $move_categories_info, Auth $auth)
    {
        $this->bookmark_category_service->moveOfficeUserCategory(
            $move_categories_info, $auth->getOfficeNo(), $auth->getOfficeUserNo()
        );

        return response('success');
    }

    public function deleteOfficeCategory(DeleteBookmarkCategoryRequest $delete_bookmark_category_request, Auth $auth)
    {
        $this->bookmark_category_service->deleteOfficeCategory(
            $delete_bookmark_category_request,
            $auth->getOfficeNo()
        );

        return response('success');
    }

    public function deleteOfficeUserCategory(BookmarkCategory $bookmark_category, Auth $auth)
    {
        $this->bookmark_category_service->deleteOfficeUserCategory(
            $bookmark_category,
            $auth->getOfficeNo(),
            $auth->getOfficeUserNo()
        );

        return response('success');
    }
}
