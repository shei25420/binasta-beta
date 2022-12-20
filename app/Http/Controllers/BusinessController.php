<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Country;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BusinessController extends Controller
{
    public function index () {
        return Inertia::render('Business/Index', [
            'countries' => Country::select('id', 'name')->get(),
            'posts' => Blog::select('blog_category_id', 'slug', 'title', 'description', 'image_path', 'created_at')->with(['blogCategory' => function ($query) {
                $query->select('id', 'name');
            }])->where('type', 0)->get()
        ]);
    }
}
