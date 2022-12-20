<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'product_category_id' => 'required|exists:product_categories,id',
            'name' => 'required|string|unique:products,name',
            'description' => 'required|string',
            'ingredients' => 'required|string',
            // 'images' => 'nullable',
            // 'images.*' => 'required_unless:images,null|image|mimes:png,jpg,jpeg,gif'
        ];
    }
}
