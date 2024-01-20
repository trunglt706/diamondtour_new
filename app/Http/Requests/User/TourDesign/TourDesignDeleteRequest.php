<?php

namespace App\Http\Requests\User\TourDesign;

use Illuminate\Foundation\Http\FormRequest;

class TourDesignDeleteRequest extends FormRequest
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
            'id' => 'required|exists:tour_designs,id'
        ];
    }

    public function messages(): array
    {
        return [
            'id.required' => 'Chọn thông tin thiết kế!',
            'id.exists' => 'Thông tin thiết kế này không tồn tại!',
        ];
    }
}
