<?php


namespace App\Providers;

use App\Http\Repositories\BookmarkCategories\BookmarkCategoryRepository;
use App\Http\Services\BookmarkCategories\BookmarkCategoryService;
use App\Http\Services\BookmarkCategories\BookmarkCategoryServiceImpl;
use Illuminate\Support\ServiceProvider;

class ServicesProvider extends ServiceProvider
{
    /**
     *
     */
    public function register()
    {
        $this->app->bind(BookmarkCategoryService::class, function ($app) {
            return new BookmarkCategoryServiceImpl(
                $app->make(BookmarkCategoryRepository::class)
            );
        });
    }

}
