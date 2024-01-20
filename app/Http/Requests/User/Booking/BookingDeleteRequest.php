<?php

namespace App\Http\Requests\User\Booking;

use Illuminate\Foundation\Http\FormRequest;

class BookingDeleteRequest extends FormRequest
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
            'id' => 'required|exists:bookings,id'
        ];
    }

    public function messages(): array
    {
        return [
            'id.required' => 'Chọn thông tin đặt lịch!',
            'id.exists' => 'Thông tin đặt lịch này không tồn tại!',
        ];
    }
}
