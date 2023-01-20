<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDistributorPackageRequest extends FormRequest
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
            'name' => 'required|unique:distributor_packages,name',
            'description' => 'required|string',
            'image' => 'required|image|mimes:png,jpg,webp,avif,gif,jpeg',
            'product_options' => 'required',
            'product_options.*' => 'required|numeric|exists:product_options,id',
        ];
    }
}
