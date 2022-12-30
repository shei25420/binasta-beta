<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDistributorOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth("distributor")->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'location' => 'string',
            'phone_number' => 'string',
            'distributor_address_id' => 'nullable|numeric|exists:user_addresses,id',
            'distributor_packages.*' => 'required',
            'distributor_packages.*.id' => 'required|numeric|exists:distributor_packages,id',
            'distributor_packages.*.qty' => 'required|numeric'
        ];
    }
}
