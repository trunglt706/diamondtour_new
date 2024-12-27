<?php

namespace App\Http\Requests\User\Event;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

class EventUpdateRequest extends FormRequest
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
            'id' => 'required|exists:events,id',
            'title' => 'required',
            'image' => [
                'nullable',
                File::image()->between(6, MAX_FILE_SIZE_UPLOAD)
            ],
            'background' => [
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
            'id.required' => 'Chọn sự kiện!',
            'id.exists' => 'Sự kiện này không tồn tại!',
            'title.required' => 'Nhập tiêu đề sự kiện!',
            'content.required' => 'Nhập nội dung sự kiện!',
            'important.integer' => 'Giá trị độ ưu tiên chưa đúng!',
            'image.image' => 'Hình ảnh chưa đúng định dạng!',
            'image.between' => 'Kích thước hình ảnh chưa phù hợp!',
            'background.image' => 'Ảnh nền chưa đúng định dạng!',
            'background.between' => 'Kích thước ảnh nền chưa phù hợp!'
        ];
    }
}
