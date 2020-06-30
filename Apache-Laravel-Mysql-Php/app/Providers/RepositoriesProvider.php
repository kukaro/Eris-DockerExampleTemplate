<?php


namespace App\Providers;


use App\Http\Repositories\BookmarkCategories\BookmarkCategoryRepository;
use App\Http\Repositories\BookmarkCategories\BookmarkCategoryRepositoryImpl;
use Illuminate\Support\ServiceProvider;

class RepositoriesProvider extends ServiceProvider
{
    /**
     *
     */
    public function register()
    {
        $this->app->bind(BookmarkCategoryRepository::class, function ($app) {
            return new BookmarkCategoryRepositoryImpl();
        });
    }

}
