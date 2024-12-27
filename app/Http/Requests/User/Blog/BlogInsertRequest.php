<?php

namespace App\Http\Requests\User\Blog;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

class BlogInsertRequest extends FormRequest
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
            'group_id' => 'required|exists:post_groups,id',
            'name' => 'required',
            'image' => [
                'nullable',
                File::image()->between(6, MAX_FILE_SIZE_UPLOAD)
            ],
            'content' => 'required',
            'important' => 'nullable|integer'
        ];
    }

    public function messages(): array
    {
        return [
            'group_id.required' => 'Chọn danh mục!',
            'group_id.exists' => 'Danh mục này không tồn tại!',
            'name.required' => 'Nhập tiêu đề blog!',
            'content.required' => 'Nhập nội dung blog!',
            'important.integer' => 'Giá trị độ ưu tiên chưa đúng!',
            'image.image' => 'Hình ảnh chưa đúng định dạng!',
            'image.between' => 'Kích thước hình ảnh chưa phù hợp!'
        ];
    }
}
