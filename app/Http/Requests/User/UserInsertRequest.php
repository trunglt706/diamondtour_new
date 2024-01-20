<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserInsertRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email|unique:users,email',
            'name' => 'required',
            'password' => 'required|between:6,30',
            'confirm_password' => 'required|same:password'
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Nhập email!',
            'email.email' => 'Email không đúng định dạng!',
            'email.unique' => 'Email đã tồn tại!',
            'name.required' => 'Nhập tên!',
            'password.required' => 'Nhập mật khẩu',
            'password.between' => 'Độ dài mật khẩu từ 6 - 30 ký tự!',
            'confirm_password.required' => 'Nhập mật khẩu xác nhận!',
            'confirm_password.same' => 'Mật khẩu xác nhận chưa đúng!',
        ];
    }
}
