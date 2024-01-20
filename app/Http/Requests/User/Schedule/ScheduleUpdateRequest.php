<?php

namespace App\Http\Requests\User\Schedule;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

class ScheduleUpdateRequest extends FormRequest
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
            'id' => 'required|exists:schedules,id',
            'tour_id' => 'required|exists:tours,id',
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
            'id.required' => 'Chọn lịch trình!',
            'id.exists' => 'Lịch trình này không tồn tại!',
            'tour_id.required' => 'Chọn tour!',
            'tour_id.exists' => 'Tour này không tồn tại!',
            'name.required' => 'Nhập tên lịch trình!',
            'image.image' => 'Hình ảnh chưa đúng định dạng!',
            'image.between' => 'Kích thước hình ảnh chưa phù hợp!',
        ];
    }
}
