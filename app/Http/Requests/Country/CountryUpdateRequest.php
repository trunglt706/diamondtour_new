<?php

namespace App\Http\Requests\Country;

use Illuminate\Foundation\Http\FormRequest;

class CountryUpdateRequest extends FormRequest
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
            'id' => 'required|exists:countries,id',
            'name' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'id.required' => 'Chọn quốc gia!',
            'id.exists' => 'Quốc gia này không tồn tại!',
            'name.required' => 'Nhập tên quốc gia'
        ];
    }
}
