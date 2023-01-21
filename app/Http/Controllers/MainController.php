<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogCategory;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MainController extends Controller
{
    public function index () {
        return Inertia::render('Main/Index', [
            'posts' => Blog::select('slug', 'image_path', 'title', 'description', 'post', 'created_at')->where('type', 0)->get()
        ]);
    }

    public function howItWorks () {
        return Inertia::render('Main/HowItWorks');   
    }

    public function faqs () {
        return Inertia::render('Main/Faqs');
    }

    public function blog () {
        return Inertia::render('Main/Blog', [
            'posts' => Blog::select('slug', 'title', 'description', 'type', 'created_at', 'image_path', 'link_path')->get()
        ]);
    }

    public function singlePost ($slug) {
        $data = Validator::make(['slug' => $slug], ['slug' => 'required|string|exists:blogs,slug'])->validated();
        return Inertia::render('Main/SinglePost', [
            'post' => Blog::select('title', 'post', 'image_path', 'created_at')->where('slug', $data['slug'])->first(),
            'new_posts' => Blog::select('slug', 'title', 'image_path', 'create_at')->where('type', 0)->latest()->pluck(3),
            'categories' => BlogCategory::select('id', 'name')->get()
        ]);
    }

    public function contact () {
        return Inertia::render('Main/Contact');
    }

    public function terms () {
        return Inertia::render('Main/Terms');
    }
}
