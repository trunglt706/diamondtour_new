<?php

namespace App\Http\Requests\User\Contact;

use Illuminate\Foundation\Http\FormRequest;

class ContactInsertRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|email',
            'question' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nhập tên người liên hệ!',
            'email.required' => 'Nhập email người liên hệ!',
            'email.email' => 'Email chưa đúng định dạng!',
            'question.required' => 'Nhập nội dung!'
        ];
    }
}
