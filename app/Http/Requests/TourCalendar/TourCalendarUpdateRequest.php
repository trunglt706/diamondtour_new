<?php

namespace App\Http\Requests\TourCalendar;

use Illuminate\Foundation\Http\FormRequest;

class TourCalendarUpdateRequest extends FormRequest
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
            'tour_id' => 'required|exists:tours,id',
            'start' => 'required|date',
            'end' => 'required|date',
        ];
    }

    public function messages(): array
    {
        return [
            'id.required' => 'Chọn lịch khởi hàng!',
            'id.exists' => 'Lịch khởi hành này không tồn tại!',
            'tour_id.required' => 'Chọn tour!',
            'tour_id.exists' => 'Tour này không tồn tại!',
            'start.required' => 'Nhập ngày bắt đầu!',
            'start.date' => 'Ngày bắt đầu chưa đúng định dạng!',
            'end.required' => 'Nhập ngày kết thúc!',
            'end.date' => 'Ngày kết thúc chưa đúng định dạng!',
        ];
    }
}
