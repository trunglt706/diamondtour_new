<?php

namespace App\Http\Requests\Province;

use Illuminate\Foundation\Http\FormRequest;

class ProvinceDeleteRequest extends FormRequest
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
            'id' => 'required|exists:provinces,id'
        ];
    }

    public function messages()
    {
        return [
            'id.required' => 'Chọn khu vực!',
            'id.exists' => 'Khu vực này không tồn tại!'
        ];
    }
}
