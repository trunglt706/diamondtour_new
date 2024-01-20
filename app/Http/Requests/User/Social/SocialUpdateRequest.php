<?php

namespace App\Http\Requests\User\Social;

use Illuminate\Foundation\Http\FormRequest;

class SocialUpdateRequest extends FormRequest
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
            'id' => 'required|exists:socials,id',
            'name' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'id.required' => 'Chọn mạng xã hội!',
            'id.exists' => 'Mạng xã hội này không tồn tại!',
            'name.required' => 'Nhập tên mạng xã hội!'
        ];
    }
}
