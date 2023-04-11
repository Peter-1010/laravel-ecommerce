<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OptionRequest extends FormRequest
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
            'name'         => 'required|max:100',
            'price'        => 'required|numeric|min:0',
            'product_id'   => 'required|exists:products,id',
            'attribute_id' => 'required|exists:attributes,id',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => __('admin/messages.required name'),
            'price.required' => __('admin/messages.required price'),
            'price.numeric' => __('admin/messages.numeric price'),
            'price.min' => __('admin/messages.min price'),
            'product_id.required' => __('admin/messages.required product_id'),
            'attribute_id.required' => __('admin/messages.required attribute_id'),
            'product_id.exists' => __('admin/messages.product_id exists'),
            'attribute_id.exists' => __('admin/messages.attribute_id exists'),
        ];
    }
}
