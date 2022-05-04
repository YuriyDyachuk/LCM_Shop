<?php

declare(strict_types=1);

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ShippingAddressRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required',
            'last_name'  => 'required',
            'post_code'  => 'required',
            'country'    => 'required',
            'address'    => 'required',
            'company'    => 'required',
            'suite'      => 'required',
            'state'      => 'required',
            'phone'      => 'required',
            'city'       => 'required'
        ];
    }
}
