<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Inertia\Inertia;
use App\Models\Image;
use Illuminate\Support\Str;
use App\Models\BlogCategory;
use App\Http\Requests\StoreBlogRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateBlogRequest;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Admin/Blogs', [
            'blogs' => Blog::select('id', 'blog_category_id', 'title', 'description', 'link_path', 'image_path', 'post', 'type', 'created_at')->with('blogCategory')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Admin/NewBlog', [
            'categories' => BlogCategory::select('id', 'name')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBlogRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBlogRequest $request)
    {
        $data = $request->validated();

        $data['post'] = $data['blog_post'];
        if($data['type'] == 0) {
            $data['slug'] = Str::slug($data['title']);
            $data['image_path'] = Storage::disk('public')->put('blogs', $request->file('image'));
        }

        Blog::create($data);
        return response()->redirectTo('/blogs');
    }

    public function edit ($id) {
        $id = Validator::make(['id' => $id], ['id' => 'required|numeric|exists:blogs,id'])->validated()['id'];

        return Inertia::render('Admin/UpdateBlog', [
            'post' => Blog::find($id),
            'categories' => BlogCategory::select('id', 'name')->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBlogRequest  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update($subdomain, UpdateBlogRequest $request, $id)
    {
        $data = $request->validated();
        $data['id'] = Validator::make(['id' => $id], ['id' => 'required|numeric|exists:blogs,id'])->validated();
        $data['slug'] = Str::slug($data['title']);

        $post = Blog::where('id', $data['id'])->first();

        if($request->hasFile('image') && $data['type'] == 0) {
            //Delete Previous file
            Storage::disk('public')->delete($post->image_path);
            $data['image_path'] = Storage::disk('public')->put('product_images', $request->file('image'));
        }   

        $post->update($data);
        return response()->redirectTo('/blogs');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy($subdomain, $id)
    {

        $id = Validator::make(['id' => $id], ['id' => 'required|numeric|exists:blogs,id'])->validated()['id'];
        $post = Blog::find($id);
        
        Storage::disk('public')->delete($post->image_path);
        $post->delete();
        return response()->redirectTo('/blogs');
    }
}
