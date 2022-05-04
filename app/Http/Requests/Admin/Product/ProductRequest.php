<?php

namespace App\Http\Requests\Admin\Product;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class ProductRequest extends FormRequest
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
            'category_id' => 'required|numeric|min:1',
            'name' => 'required|string|unique:products,name,' . $this->request->get('item_id', 0),
            'sku' => 'required|string|unique:products,sku,' . $this->request->get('item_id', 0),
            'price' => 'required|numeric|min:1',
            'quantity' => 'numeric|min:1|nullable',
            'description' => 'string|nullable',
            'image' => 'image|max:2048',
            'in_stock' => 'boolean',
            'is_virtual' => 'boolean',
            'is_active' => 'boolean',
            'seo.title' => 'string|max:255|nullable',
            'seo.description' => 'string|max:1024|nullable',
        ];
    }

}

