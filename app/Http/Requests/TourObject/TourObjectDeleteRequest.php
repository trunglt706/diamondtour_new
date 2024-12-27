<?php

namespace App\Http\Requests\TourObject;

use Illuminate\Foundation\Http\FormRequest;

class TourObjectDeleteRequest extends FormRequest
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
            'id' => 'required|exists:tour_objects,id'
        ];
    }

    public function messages(): array
    {
        return [
            'id.required' => 'Chọn đối tượng!',
            'id.exists' => 'Đối tượng này không tồn tại!',
        ];
    }
}
