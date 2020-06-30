<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookmarkCategory extends Model
{
    protected $connection = 'hiworks_master';
    protected $primaryKey = 'no';
    protected $table = 'bookmark_categories';
    protected $fillable = ['name', 'is_del', 'parent_category_no'];

    public function bookmarkCategories()
    {
        return $this->hasMany(BookmarkCategory::class, 'parent_category_no')
            ->with(['bookmarkCategories','bookmark'])
            ->where('is_del','n');
    }

    public function childBookmarkCategories()
    {
        return $this
            ->hasMany(BookmarkCategory::class, 'parent_category_no')
            ->with(['bookmarkCategories', 'bookmark']);
    }

    public function bookmark()
    {
        return $this->hasOne(Bookmark::class, 'bookmark_categories_no','no');
    }
}
