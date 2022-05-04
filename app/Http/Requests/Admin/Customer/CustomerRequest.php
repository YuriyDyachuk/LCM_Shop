<?php

namespace App\Http\Requests\Admin\Customer;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $this->request->get('item_id', 0),
            'phone' => 'required|string|max:255',
            'password' => 'required_if:item_id,null|string|min:6|confirmed|nullable',
            'address.state_name' => 'string|max:255|nullable',
            'address.city_name' => 'string|max:255|nullable',
            'address.zip_code' => 'string|max:255|nullable',
            'address.address' => 'string|max:255|nullable'
        ];
    }

    public function messages()
    {
        return [
            'password.required_if' => 'The password field is required.'
        ];
    }
}

