<?php

namespace App\Http\Requests\User\Destination;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

class DestinationInsertRequest extends FormRequest
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
            'group_id' => 'required|exists:destination_groups,id',
            'country_id' => 'nullable|exists:countries,id',
            'province_id' => 'nullable|exists:provinces,id',
            'name' => 'required',
            'image' => [
                'nullable',
                File::image()->between(1, MAX_FILE_SIZE_UPLOAD),
            ],
            'image_description' => [
                'nullable',
                File::image()->between(1, MAX_FILE_SIZE_UPLOAD),
            ],
            'image_content' => [
                'nullable',
                File::image()->between(1, MAX_FILE_SIZE_UPLOAD),
            ],
            'content' => 'required',
            'important' => 'nullable|integer',
        ];
    }

    public function messages(): array
    {
        return [
            'group_id.required' => 'Chọn danh mục!',
            'group_id.exists' => 'Danh mục không tồn tại!',
            'country_id.exists' => 'Quốc gia này không tồn tại!',
            'province_id.exists' => 'Tỉnh thành này không tồn tại!',
            'name.required' => 'Nhập tiêu đề điểm đến!',
            'image.image' => 'Hình ảnh chưa đúng định dạng!',
            'image.between' => 'Kích thước hình ảnh chưa phù hợp!',
            'image_description.image' => 'Hình ảnh mô tả điểm đến chưa đúng định dạng!',
            'image_description.between' => 'Kích thước hình ảnh mô tả điểm đến chưa phù hợp!',
            'image_content.image' => 'Hình ảnh mô tả địa chỉ chưa đúng định dạng!',
            'image_content.between' => 'Kích thước hình ảnh mô tả địa chỉ chưa phù hợp!',
            'content.required' => 'nhập nội dung!',
            'important.integer' => 'Giá trị độ ưu tiên chưa đúng!'
        ];
    }
}
