<?php

namespace App\Http\Requests\Admin\Sale;

use App\Models\Sale\Discount;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DiscountRequest extends FormRequest
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
            'name' => 'required|string|unique:discounts,name,' . $this->request->get('item_id', 0),
            'product_apply_type' => [
                'required',
                Rule::in(array_keys(Discount::PRODUCT_APPLY_TYPE_NAMES)),
            ],
            'type' => [
                'required',
                Rule::in(array_keys(Discount::TYPE_NAMES)),
            ],
            'rule' => 'required|array',
            'priority' => 'required|numeric|min:1',
            'is_active' => 'boolean',
        ];
    }

}

