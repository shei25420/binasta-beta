<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDistributorRequest extends FormRequest
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
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string',
            'country_id' => 'required|numeric|exists:countries,id',
            'gender' => 'required|numeric|min:0|max:1',
            'domain' => 'required|string|unique:distributors,domain',
            'parent_distributor_id' => 'nullable|numeric|exists:distributors,id'
        ];
    }
}
