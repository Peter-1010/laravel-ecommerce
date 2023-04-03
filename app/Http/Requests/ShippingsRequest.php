<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShippingsRequest extends FormRequest
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
            'id'          => 'required|exists:settings',
            'value'       => 'required',
            'plain_value' => 'nullable|numeric',
        ];
    }

    public function messages()
    {
        return [
            'id.required'          => __('admin/messages.required id'),
            'id.email'             => __('admin/messages.id exists'),
            'value.required'       => __('admin/messages.required value'),
            'plain_value.numeric' => __('admin/messages.numeric plain_value'),
        ];
    }
}
