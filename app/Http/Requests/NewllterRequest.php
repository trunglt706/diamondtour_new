<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewllterRequest extends FormRequest
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
            'email' => 'required|email|unique:newllters,email'
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Nhập email!',
            'email.email' => 'Email chưa đúng định dạng!',
            'email.unique' => 'Email này đã tồn tại!',
        ];
    }
}
