<?php

namespace App\Http\Requests\User\LibraryGroup;

use Illuminate\Foundation\Http\FormRequest;

class LibraryGroupDeleteRequest extends FormRequest
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
            'id' => 'required|exists:library_groups,id'
        ];
    }

    public function messages(): array
    {
        return [
            'id.required' => 'Chọn danh mục thư viện!',
            'id.exists' => 'Danh mục thư viện này không tồn tại!',
        ];
    }
}
