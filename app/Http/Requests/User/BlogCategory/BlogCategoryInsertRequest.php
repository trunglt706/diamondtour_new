<?php

namespace App\Http\Requests\User\BlogCategory;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

class BlogCategoryInsertRequest extends FormRequest
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
            'numering' => 'nullable|integer|min:0',
            'status' => 'nullable|in:active,blocked'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nhập tên danh mục!',
            'image.image' => 'Hình ảnh chưa đúng định dạng!',
            'image.between' => 'Kích thước hình ảnh chưa phù hợp!',
            'numering.integer' => 'Giá tị thứ tự ưu tiên chưa hợp lệ!',
            'numering.min' => 'Giá tị thứ tự ưu tiên chưa hợp lệ!',
            'status.in' => 'Giá tị trạng thái chưa hợp lệ!',
        ];
    }
}
