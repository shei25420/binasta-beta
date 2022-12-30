<?php

namespace App\Models;

use Hyn\Tenancy\Traits\UsesSystemConnection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory, UsesSystemConnection;

    protected $fillable = ['slug', 'blog_category_id', 'title', 'description', 'post', 'type', 'link_path', 'image_path'];

    public function blogCategory () {
        return $this->belongsTo(BlogCategory::class);
    }
}
