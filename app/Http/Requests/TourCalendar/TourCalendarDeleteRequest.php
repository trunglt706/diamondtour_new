<?php

namespace App\Http\Requests\TourCalendar;

use Illuminate\Foundation\Http\FormRequest;

class TourCalendarDeleteRequest extends FormRequest
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
            'id' => 'required|exists:tour_calendars,id',
        ];
    }

    public function messages(): array
    {
        return [
            'id.required' => 'Chọn lịch khởi hàng!',
            'id.exists' => 'Lịch khởi hành này không tồn tại!',
        ];
    }
}
