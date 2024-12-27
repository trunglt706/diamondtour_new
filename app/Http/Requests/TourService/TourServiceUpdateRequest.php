<?php

namespace App\Http\Requests\TourService;

use Illuminate\Foundation\Http\FormRequest;

class TourServiceUpdateRequest extends FormRequest
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
            'id' => 'required|exists:tour_services,id',
            'name' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'id.required' => 'Chọn dịch vụ!',
            'id.exists' => 'Dịch vụ này không tồn tại!',
            'name.required' => 'Nhập tên dịch vụ!'
        ];
    }
}
