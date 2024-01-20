<?php

namespace App\Http\Requests\User\Booking;

use Illuminate\Foundation\Http\FormRequest;

class BookingUpdateRequest extends FormRequest
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
            'id' => 'required|exists:bookings,id',
            'name' => 'required',
            'phone' => 'required',
            'date_from' => 'required|date:Y-m-d',
            'date_to' => 'required|date:Y-m-d',
            'total_adult' => 'nullable|integer|min:0',
            'total_children' => 'nullable|integer|min:0',
            'content' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'id.required' => 'Chọn thông tin đặt lịch!',
            'id.exists' => 'Thông tin đặt lịch không tồn tại!',
            'name.required' => 'Nhập tên khách!',
            'phone.required' => 'Nhập điện thoại!',
            'date_from.required' => 'Nhập ngày bắt đầu!',
            'date_from.date' => 'Ngày bắt đầu chưa đúng định dạng!',
            'total_adult.integer' => 'Số lượng người lớn chưa đúng!',
            'total_adult.min' => 'Số lượng người lớn chưa đúng!',
            'total_children.integer' => 'Số lượng trẻ em chưa đúng!',
            'total_children.min' => 'Số lượng trẻ em chưa đúng!',
            'content.required' => 'Nhập nội dung!'
        ];
    }
}
