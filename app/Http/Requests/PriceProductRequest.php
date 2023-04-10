<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PriceProductRequest extends FormRequest
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
            'price'               => 'required|min:0|numeric',
            'product_id'          => 'required|exists:products,id',
            'special_price'       => 'nullable|numeric',
            'special_price_type'  => 'nullable|max:500|required_with:special_price|in:percent,fixed',
            'special_price_start' => 'required_with:special_price|date_format:Y-m-d',
            'special_price_end'   => 'required_with:special_price|date_format:Y-m-d',
        ];
    }

    public function messages()
    {
        return [
            'price.required' => __('admin/messages.required price'),
            'product_id.required' => __('admin/messages.required product_id'),
            'special_price_start.required_with' => __('admin/messages.required special_price_start'),
            'special_price_end.required_with' => __('admin/messages.required special_price_end'),
        ];
    }
}
