<?php

namespace App\Http\Requests\User\Qa;

use Illuminate\Foundation\Http\FormRequest;

class QaUpdateRequest extends FormRequest
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
            'id' => 'required|exists:qas,id',
            'name' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'id.required' => 'Chọn câu hỏi!',
            'id.exists' => 'Câu hỏi này không tồn tại!',
            'name.required' => 'Nhập câu hỏi!'
        ];
    }
}
