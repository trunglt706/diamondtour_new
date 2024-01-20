<?php

namespace App\Http\Requests\User\DestinationGroup;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

class DestinationGroupUpdateRequest extends FormRequest
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
            'id' => 'required|exists:destination_groups,id',
            'name' => 'required',
            'image' => [
                'nullable',
                File::image()->between(1, MAX_FILE_SIZE_UPLOAD)
            ],
            'type' => 'required|in:national,local'
        ];
    }

    public function messages(): array
    {
        return [
            'id.required' => 'Chọn danh mục điểm đến!',
            'id.exists' => 'Danh mục điểm đến không tồn tại!',
            'name.required' => 'Nhập tên danh mục điểm đến!',
            'image.image' => 'Hình ảnh chưa đúng định dạng!',
            'image.between' => 'Kích thước hình ảnh chưa phù hợp!',
            'type.required' => 'Nhập loại điểm đến!',
            'type.in' => 'Giá trị loại điểm đến chưa đúng!',
        ];
    }
}
