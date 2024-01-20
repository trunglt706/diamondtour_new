<?php

namespace App\Http\Requests\User\TourGroup;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

class TourGroupUpdateRequest extends FormRequest
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
            'id' => 'required|exists:tour_groups,id',
            'name' => 'required',
            'image' => [
                'nullable',
                File::image()->between(1, MAX_FILE_SIZE_UPLOAD)
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'id.required' => 'Chọn danh mục tour!',
            'id.exists' => 'Danh mục này không tồn tại!',
            'name' => 'Nhập tên danh mục!',
            'image.image' => 'Hình ảnh chưa đúng định dạng!',
            'image.between' => 'Kích thước hình ảnh chưa đúng!',
        ];
    }
}
