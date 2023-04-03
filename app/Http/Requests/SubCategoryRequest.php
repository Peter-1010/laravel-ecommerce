<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubCategoryRequest extends FormRequest
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
            'parent_id' => 'required|exists:categories,id',
            'name'      => 'required',
            'slug'      => 'required|unique:categories,slug,'. $this -> id,
        ];
    }

    public function messages()
    {
        return [
            'parent_id.required' => __('admin/messages.required parent_id'),
            'parent_id.exists'   => __('admin/messages.exists parent_id'),
            'name.required'      => __('admin/messages.required name'),
            'slug.required'      => __('admin/messages.required slug'),
            'slug.unique'        => __('admin/messages.unique slug'),
        ];
    }
}
