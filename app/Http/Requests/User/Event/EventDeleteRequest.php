<?php

namespace App\Http\Requests\User\Event;

use Illuminate\Foundation\Http\FormRequest;

class EventDeleteRequest extends FormRequest
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
            'id' => 'required|exists:events,id'
        ];
    }

    public function messages(): array
    {
        return [
            'id.required' => 'Chọn sự kiện!',
            'id.exists' => 'Sự kiện này không tồn tại!',
        ];
    }
}
