<?php

namespace App\Http\Requests\User\Contact;

use Illuminate\Foundation\Http\FormRequest;

class ContactDeleteRequest extends FormRequest
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
            'id' => 'required|exists:contacts,id'
        ];
    }

    public function messages(): array
    {
        return [
            'id.required' => 'Chọn thông tin liên hệ!',
            'id.exists' => 'Thông tin liên hệ này không tồn tại!',
        ];
    }
}
