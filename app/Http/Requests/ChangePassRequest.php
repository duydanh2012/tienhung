<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePassRequest extends FormRequest
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
            'password'    =>'min:6|required',
            'passwordNew' =>'required|min:6',
            'passwordConfirm'=>'same:passwordNew',
        ];
    }

    public function messages()
    {
        return  [
            'passwordNew.min' => 'Mật Khẩu Mới Phải Trên 6 ký tự',
            'passwordNew.required' => 'Yêu cầu nhập mật khẩu mới',  
            'password.min' => 'Mật Khẩu Phải Trên 6 ký tự',
            'password.required' => 'Yêu cầu nhập mật khẩu mới',  
            'passwordConfirm.same' => 'Nhập Lại Mật Khẩu Không Trùng Khớp'
        ];
    }
}
