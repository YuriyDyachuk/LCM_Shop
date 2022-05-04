<?php

namespace App\Http\Requests\Admin\Sale;

use App\Models\Sale\PromoCode;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PromoCodeRequest extends FormRequest
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
            'code' => 'required|string|max:255|unique:promo_codes,code,' . $this->request->get('item_id', 0),
            'amount' => 'required|numeric|min:1',
            'apply_type' => [
                'required',
                Rule::in(array_keys(PromoCode::APPLY_TYPE_NAMES)),
            ],
            'description' => 'string|max:255|nullable',
            'expiry_date_at' => 'date|nullable',
            'is_active' => 'boolean',
        ];
    }

}

