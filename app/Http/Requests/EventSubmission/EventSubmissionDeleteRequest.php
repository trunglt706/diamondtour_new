<?php

namespace App\Http\Requests\EventSubmission;

use Illuminate\Foundation\Http\FormRequest;

class EventSubmissionDeleteRequest extends FormRequest
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
            'id' => 'required|exists:event_submissions,id'
        ];
    }

    public function messages(): array
    {
        return [
            'id.required' => 'Chọn bài tham dự!',
            'id.exists' => 'Bài tham dự này không tồn tại!',
        ];
    }
}
