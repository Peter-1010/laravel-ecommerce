<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'name'              => 'required|max:100',
            'slug'              => 'required|unique:products,slug',
            'description'       => 'required|max:1000',
            'short_description' => 'nullable|max:500',
            'categories'        => 'array|min:1',
            'categories.*'      => 'numeric|exists:categories,id',
            'tags'              => 'nullable',
            'brand_id'          => 'required|exists:brands,id',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => __('admin/messages.required name'),
            'slug.required' => __('admin/messages.required slug'),
            'description.required' => __('admin/messages.required description'),
            'brand_id.required' => __('admin/messages.required brand_id'),
            'slug.unique'   => __('admin/messages.unique slug'),
        ];
    }
}
