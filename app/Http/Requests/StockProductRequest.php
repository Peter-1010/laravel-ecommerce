<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StockProductRequest extends FormRequest
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
            'sku'          => 'nullable|min:3|max:10',
            'product_id'   => 'required|exists:products,id',
            'manage_stock' => 'required|in:0,1',
            'in_stock'     => 'required|in:0,1',
            'qty'          => 'required_if:manage_stock,==,1',
        ];
    }

    public function messages()
    {
        return [
            'sku.min'               => __('admin/messages.min sku'),
            'sku.max'               => __('admin/messages.max sku'),
            'product_id.required'   => __('admin/messages.required product_id'),
            'manage_stock.required' => __('admin/messages.required manage_stock'),
            'in_stock.required'     => __('admin/messages.required in_stock'),
            'qty.required_if'       => __('admin/messages.required_if qty'),
        ];
    }
}
