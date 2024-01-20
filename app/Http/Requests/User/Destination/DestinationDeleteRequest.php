<?php

namespace App\Http\Requests\User\Destination;

use Illuminate\Foundation\Http\FormRequest;

class DestinationDeleteRequest extends FormRequest
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
            'id' => 'required|exists:destinations,id'
        ];
    }

    public function messages(): array
    {
        return [
            'id.required' => 'Chọn điểm đến!',
            'id.exists' => 'Điểm đến này không tồn tại!',
        ];
    }
}
