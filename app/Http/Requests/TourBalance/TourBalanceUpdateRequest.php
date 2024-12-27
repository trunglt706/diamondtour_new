<?php

namespace App\Http\Requests\TourBalance;

use Illuminate\Foundation\Http\FormRequest;

class TourBalanceUpdateRequest extends FormRequest
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
            'id' => 'required|exists:tour_balances,id',
            'name' => 'required',
            'from' => 'required|integer|min:0',
            'to' => 'required|integer|min:0'
        ];
    }

    public function messages(): array
    {
        return [
            'id.required' => 'Chọn ngân sách!',
            'id.exists' => 'Ngân sách này không tồn tại!',
            'name.required' => 'Nhập tên ngân sách!',
            'from.required' => 'Nhập giá trị từ!',
            'from.integer' => 'Giá trị từ không hợp lệ!',
            'from.min' => 'Giá trị từ không hợp lệ!',
            'to.required' => 'Nhập giá trị đến!',
            'to.integer' => 'Giá trị đến không hợp lệ!',
            'to.min' => 'Giá trị đến không hợp lệ!',
        ];
    }
}
