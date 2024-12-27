<?php

namespace App\Http\Requests\User\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginSubmitRequest extends FormRequest
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
            'email' => 'required|exists:users,email|email',
            'password' => 'required|between:6,30'
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Nhập email!',
            'email.exists' => 'Email này không tồn tại!',
            'password.required' => 'Nhập mật khẩu!',
            'password.between' => 'Độ dài mật khẩu từ 6 - 30 ký tự!'
        ];
    }
}
