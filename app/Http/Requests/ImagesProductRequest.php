<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImagesProductRequest extends FormRequest
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
            'product_id' => 'required|exists:products,id',
            'document'   => 'required|array|min:1',
            'document.*' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'sku.min'               => __('admin/messages.min sku'),
            'sku.max'               => __('admin/messages.max sku'),
            'product_id.required'   => __('admin/messages.required product_id'),
            'document.required' => __('admin/messages.required document'),
            'in_stock.required'     => __('admin/messages.required in_stock'),
            'qty.required_if'       => __('admin/messages.required_if qty'),
        ];
    }
}
