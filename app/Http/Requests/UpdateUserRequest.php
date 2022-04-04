<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'name'                  => 'required',
            'email'                 => 'required|max:60|min:6|email',
        ];
    }

    public function messages()
    {
        return [
            'email.required'                 => 'Vui lòng nhập email',
            'email.max'                      => 'Email tối đa 60 ký tự',
            'email.min'                      => 'Email tối thiểu 60 ký tự',
            'email.email'                    => 'Email không hợp lệ',
            'name'                           => 'Vui lòng nhập họ và tên',                        
        ];
    }
}
