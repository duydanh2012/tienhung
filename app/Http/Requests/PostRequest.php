<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'name'        => 'required|max:200',
            'description' => 'max:400',
        ];
    }

    public function messages()
    {
        return [
            'name.required'   => 'Vui lòng nhập tiêu đề bài viết',
            'name.max'        => 'Tiêu đề tối đa 200 ký tự',
            'description.max' => 'Mô tả tối đa 400 ký tự',
        ];
    }
}
