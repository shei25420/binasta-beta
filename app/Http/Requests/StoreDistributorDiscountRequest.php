<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDistributorDiscountRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth("admin")->id();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "distributor_package_id" => "required|numeric|exists:distributor_packages,id",
            "percentage" => "required|numeric",
            "start_date" => "required|string",
            "end_date" => "required|string"
        ];
    }
}
