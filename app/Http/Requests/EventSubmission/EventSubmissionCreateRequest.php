<?php

namespace App\Http\Requests\EventSubmission;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

class EventSubmissionCreateRequest extends FormRequest
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
                File::image()->between(6, MAX_FILE_SIZE_UPLOAD)
            ],
            'description' => 'required',
            'position' => 'required',
            'event_id' => 'required|exists:events,id'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nhập tên người tham dự!',
            'description.required' => 'Nhập nội dung mô tả!',
            'position.required' => 'Nhập chức vụ!',
            'image.image' => 'Hình ảnh chưa đúng định dạng!',
            'image.between' => 'Kích thước hình ảnh chưa phù hợp!',
            'event_id.required' => 'Chọn sự kiện!',
            'event_id.exists' => 'Sự kiện không tồn tại!',
        ];
    }
}
