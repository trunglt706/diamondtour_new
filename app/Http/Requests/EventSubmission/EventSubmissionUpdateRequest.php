<?php

namespace App\Http\Requests\EventSubmission;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

class EventSubmissionUpdateRequest extends FormRequest
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
            'id' => 'required|exists:event_submissions,id',
            'name' => 'required',
            'image' => [
                'nullable',
                File::image()->between(6, MAX_FILE_SIZE_UPLOAD)
            ],
            'description' => 'required',
            'position' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'id.required' => 'Chọn bài tham dự!',
            'id.exists' => 'Bài tham dự này không tồn tại!',
            'name.required' => 'Nhập tên người tham dự!',
            'description.required' => 'Nhập nội dung mô tả!',
            'position.required' => 'Nhập chức vụ!',
        ];
    }
}
