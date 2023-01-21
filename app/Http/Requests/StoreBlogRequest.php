<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBlogRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth('admin')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'blog_category_id' => 'required|numeric|exists:blog_categories,id',
            'title' => 'required|string|unique:blogs,title',
            'description' => 'string|nullable',
            'type' => 'required|numeric|min:0|max:3',
            'blog_post' => 'string|nullable',
            'link_path' => 'string|nullable',
            'image' => 'nullable|image|mimes:png,jpg,jpeg,gif,svg'
        ];
    }
}
