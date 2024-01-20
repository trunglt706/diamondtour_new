<?php

namespace App\Http\Requests\User\Tour;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

class TourInsertRequest extends FormRequest
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
            'group_id' => 'required|exists:tour_groups,id',
            'country_id' => 'nullable|exists:countries,id',
            'province_id' => 'nullable|exists:provinces,id',
            'name' => 'required',
            'background' => [
                'nullable',
                File::image()->between(1, MAX_FILE_SIZE_UPLOAD)
            ],
            'content' => 'required',
            'important' => 'nullable|in:1'
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
            'background.image' => 'Ảnh nền chưa đúng định dạng!',
            'background.between' => 'Kích thước ảnh nền chưa phù hợp!',
            'content.required' => 'nhập nội dung!',
            'important.in' => 'Giá trị quan trọng chưa đúng!'
        ];
    }
}
