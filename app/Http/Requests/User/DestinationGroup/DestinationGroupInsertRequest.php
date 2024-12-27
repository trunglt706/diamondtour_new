<?php

namespace App\Http\Requests\User\DestinationGroup;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

class DestinationGroupInsertRequest extends FormRequest
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
            'image' => [
                'nullable',
                File::image()->between(1, MAX_FILE_SIZE_UPLOAD)
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nhập tên danh mục điểm đến!',
            'image.image' => 'Hình ảnh chưa đúng định dạng!',
            'image.between' => 'Kích thước hình ảnh chưa phù hợp!',
        ];
    }
}
