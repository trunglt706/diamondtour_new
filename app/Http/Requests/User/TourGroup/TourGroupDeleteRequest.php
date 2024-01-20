<?php

namespace App\Http\Requests\User\TourGroup;

use Illuminate\Foundation\Http\FormRequest;

class TourGroupDeleteRequest extends FormRequest
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
            'id' => 'required|exists:tour_groups,id'
        ];
    }

    public function messages(): array
    {
        return [
            'id.required' => 'Chọn danh mục!',
            'id.exists' => 'Danh mục này không tồn tại!',
        ];
    }
}
