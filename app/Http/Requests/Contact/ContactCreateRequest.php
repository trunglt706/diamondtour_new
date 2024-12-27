<?php

namespace App\Http\Requests\Contact;

use Illuminate\Foundation\Http\FormRequest;

class ContactCreateRequest extends FormRequest
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
            'name' => 'required|max:100',
            'phone' => 'nullable|max:15',
            'email' => 'required|email|max:100',
            'comment' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Điền tên người liên hệ',
            'name.max' => 'Tên người liên hệ chưa hợp lệ!',
            'phone.max' => 'Số điện thoại chưa hợp lệ!',
            'email.required' => 'Nhập email!',
            'email.email' => 'Email chưa hợp lệ!',
            'email.max' => 'Email chưa hợp lệ!',
            'comment.required' => 'Nhập nội dung tin nhắn!'
        ];
    }
}
