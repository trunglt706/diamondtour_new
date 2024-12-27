<?php

namespace App\Http\Requests\TourAge;

use Illuminate\Foundation\Http\FormRequest;

class TourAgeUpdateRequest extends FormRequest
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
            'id' => 'required|exists:tour_ages,id',
            'name' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'id.required' => 'Chọn độ tuổi!',
            'id.exists' => 'Độ tuổi này không tồn tại!',
            'name.required' => 'Nhập tên độ tuổi!'
        ];
    }
}
