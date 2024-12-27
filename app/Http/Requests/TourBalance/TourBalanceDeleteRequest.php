<?php

namespace App\Http\Requests\TourBalance;

use Illuminate\Foundation\Http\FormRequest;

class TourBalanceDeleteRequest extends FormRequest
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
            'id' => 'required|exists:tour_balances,id'
        ];
    }

    public function messages(): array
    {
        return [
            'id.required' => 'Chọn ngân sách!',
            'id.exists' => 'Ngân sách này không tồn tại!',
        ];
    }
}
