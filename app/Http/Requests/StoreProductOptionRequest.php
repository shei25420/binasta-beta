<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductOptionRequest extends FormRequest
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
            'product_id' => 'required|numeric|min:1|exists:products,id',
            'variation' => 'required|string',
            'buying_price' => 'required|numeric|min:1',
            'selling_price' => 'required|numeric|min:1',
            'wholesale_price' => 'required|numeric|min:1',
            'wholesale_min' => 'required|numeric|min:1',
            'stock' => 'required|numeric'
        ];
    }
}
