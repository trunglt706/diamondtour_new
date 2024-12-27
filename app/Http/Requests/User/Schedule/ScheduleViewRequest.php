<?php

namespace App\Http\Requests\User\Schedule;

use Illuminate\Foundation\Http\FormRequest;

class ScheduleViewRequest extends FormRequest
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
            'limit' => 'nullable|integer|min:10',
            'page' => 'nullable|integer|min:1',
        ];
    }

    public function messages()
    {
        return [
            'limit.integer' => 'Giá trị số lượng không hợp lệ!',
            'limit.min' => 'Giá trị số lượng không hợp lệ!',
            'page.integer' => 'Giá trị trang hiện tại không hợp lệ!',
            'page.min' => 'Giá trị trang hiện tại không hợp lệ!',
        ];
    }
}
