<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    protected $connection = 'hiworks_master';
    protected $primaryKey = 'no';
    protected $table = 'bookmarks';
    protected $fillable = ['name', 'url', 'use_end_date'];

    public function bookmarkCategory()
    {
        return $this->belongsTo(BookmarkCategory::class, 'bookmark_categories_no','no');
    }
}
