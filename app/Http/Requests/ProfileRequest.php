<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'name'     => 'required',
            'email'    => 'required|email|unique:admins,email,'. $this -> id,
            'password' => 'nullable|confirmed|min:8',

        ];
    }

    public function messages()
    {
        return [
            'name.required'      => __('admin/messages.required name'),
            'email.required'     => __('admin/messages.required email'),
            'email.email'        => __('admin/messages.email email'),
            'email.unique'       => __('admin/messages.unique email'),
            'password.min'       => __('admin/messages.password min'),
            'password.confirmed' => __('admin/messages.password confirm'),
        ];
    }
}
