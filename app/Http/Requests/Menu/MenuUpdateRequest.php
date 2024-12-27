<?php

namespace App\Http\Requests\Menu;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

class MenuUpdateRequest extends FormRequest
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
            'background' => [
                'nullable',
                File::image()->between(1, MAX_FILE_SIZE_UPLOAD)
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nhập tên menu!',
            'background.image' => 'Ảnh nền chưa đúng định dạng!',
            'background.between' => 'Kích thước ảnh nền chưa phù hợp!',
        ];
    }
}
