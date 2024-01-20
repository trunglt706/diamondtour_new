<?php

namespace App\Http\Requests\User\Library;

use Illuminate\Foundation\Http\FormRequest;

class LibraryUpdateRequest extends FormRequest
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
            'id' => 'required|exists:libraries,id',
            'group_id' => 'required|exists:library_groups,id',
            'name' => 'required',
            'important' => 'nullable|in:1'
        ];
    }

    public function messages(): array
    {
        return [
            'id.required' => 'Chọn thư viện!',
            'id.exists' => 'Thư viện này không tồn tại!',
            'group_id.required' => 'Chọn danh mục thư viện!',
            'group_id.exists' => 'Danh mục này không tồn tại!',
            'name.required' => 'Nhập tên thư viện',
            'important.in' => 'Giá trị quan trọng chưa phù hợp!'
        ];
    }
}
