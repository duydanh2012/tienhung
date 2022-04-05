<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'name'    => 'required|max:200',
            'email'   => 'required|email',
            'subject' => 'required',
            'message' => 'required',            
        ];
    }

    public function messages()
    {
        return [
            'name.required'    => 'Vui lòng nhập họ và tên!',
            'name.max'         => 'Họ tên bạn có vẻ quá dài thì phải!',
            'subject.required' => 'Vui lòng nhập tiêu đề!',
            'email.required'   => 'Vui lòng nhập email!',
            'email.email'      => 'Vui lòng nhập đúng định dạng email!',
            'message.required' => 'Vui lòng nhập nội dung tin nhắn!',
        ];
    }
}
