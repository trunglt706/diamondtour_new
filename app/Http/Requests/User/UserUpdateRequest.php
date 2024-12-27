<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|email',
            'g-recaptcha-response' => 'required|captcha'
        ];
    }

    public function messages(): array
    {
        return [
            'id.required' => 'Chọn quản trị viên!',
            'id.exists' => 'Quản trị viên này không tồn tại!',
            'name.required' => 'Nhập tên!',
            'email.required' => 'Nhập email!',
            'email.email' => 'Email không đúng định dạng!',
            'email.unique' => 'Email đã tồn tại!',
            'g-recaptcha-response.required' => 'Chọn mã captchar!',
            'g-recaptcha-response.captcha' => 'Mã captchar chưa hợp lệ hoặc đã hết hạn!',
        ];
    }
}
