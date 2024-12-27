<?php

namespace App\Http\Requests\User\Blog;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

class BlogUpdateRequest extends FormRequest
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
            'id' => 'required|exists:posts,id',
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
            'id.required' => 'Chọn blog!',
            'id.exists' => 'Blog này không tồn tại!',
            'group_id.required' => 'Chọn danh mục!',
            'group_id.exists' => 'Danh mục này không tồn tại!',
            'name.required' => 'Nhập tiêu đề blog!',
            'content.required' => 'Nhập nội dung blog!',
            'important.integer' => 'Giá trị blog độ ưu tiên chưa đúng!',
            'image.image' => 'Hình ảnh chưa đúng định dạng!',
            'image.between' => 'Kích thước hình ảnh chưa phù hợp!'
        ];
    }
}
