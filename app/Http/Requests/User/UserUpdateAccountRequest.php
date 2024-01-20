<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateAccountRequest extends FormRequest
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
            'id' => 'required|exists:users,id',
            'password' => 'required|between:6,30',
            'confirm_password' => 'required|same:password'
        ];
    }

    public function messages(): array
    {
        return [
            'id.required' => 'Chọn quản trị viên!',
            'id.exists' => 'Quản trị viên này không tồn tại!',
            'password.required' => 'Nhập mật khẩu',
            'password.between' => 'Độ dài mật khẩu từ 6 - 30 ký tự!',
            'confirm_password.required' => 'Nhập mật khẩu xác nhận!',
            'confirm_password.same' => 'Mật khẩu xác nhận chưa đúng!',
        ];
    }
}
