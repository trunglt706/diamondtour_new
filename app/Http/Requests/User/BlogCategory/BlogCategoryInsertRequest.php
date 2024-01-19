<?php

namespace App\Http\Requests\User\BlogCategory;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

class BlogCategoryInsertRequest extends FormRequest
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
            'code' => 'unique:post_groups,code',
            'image' => [
                'nullable',
                File::image()->between(1, MAX_FILE_SIZE_UPLOAD)
            ],
            'numering' => 'nullable|integer|min:0',
            'status' => 'nullable|in:active,blocked'
        ];
    }
}
