<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DesignTourRequest extends FormRequest
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
            'country_id' => 'required|exists:countries,id',
            'tour_group_id' => 'required|exists:tour_groups,id',
            // 'someone_id' => 'required|exists:tour_objects,id',
            'service_id' => 'required|exists:tour_services,id',
            'age_id' => 'required|exists:tour_ages,id',
            'place_id' => 'required|exists:provinces,id',
            'balance_id' => 'required|exists:tour_balances,id',
            'adults' => 'required|integer|min:1',
            'children' => 'required|integer|min:0',
            // 'expected_date' => 'nullable|date:d/m/Y',
            'tour_guide' => 'required|in:0,1',
            'name' => 'required',
            'phone' => 'required',
            'email' => 'nullable|email',
            'agree_terms' => 'nullable|in:1'
        ];
    }

    public function messages()
    {
        return [
            'agree_terms.in' => 'Điều kiện và điều khoản không hợp lệ!',
            'name.required' => 'Nhập họ tên!',
            'phone.required' => 'Nhập số điện thoại!',
            'email.email' => 'Địa chỉ email không hợp lệ!',
            'tour_guide.required' => 'Chọn yêu cầu hướng dẫn viên!',
            'tour_guide.in' => 'Yêu cầu hướng dẫn viên không hợp lệ!',
            'adults.required' => 'Chọn số lượng người lớn!',
            'adults.integer' => 'Số lượng người lớn không hợp lệ!',
            'adults.min' => 'Số lượng người lớn không hợp lệ!',
            'children.required' => 'Chọn số lượng trẻ em!',
            'children.integer' => 'Số lượng trẻ em không hợp lệ!',
            'children.min' => 'Số lượng trẻ em không hợp lệ!',
            // 'expected_date.date' => 'Chọn ngày dự kiến!',
            'country_id.required' => 'Chọn nơi dự định đi!',
            'country_id.exists' => 'Nơi dự định này không tồn tại!',
            'tour_group_id.required' => 'Chọn danh mục tour!',
            'tour_group_id.exists' => 'Danh mục tour này không tồn tại!',
            // 'someone_id.required' => 'Chọn người đi cùng!',
            // 'someone_id.exists' => 'Người đi cùng không tồn tại!',
            'service_id.required' => 'Chon dịch vụ mong muốn!',
            'service_id.exists' => 'Dịch vụ này không tồn tại!',
            'age_id.required' => 'Chọn độ tuổi!',
            'age_id.exists' => 'Độ tuổi này không tồn tại!',
            'place_id.required' => 'Chọn điểm khởi hành!',
            'place_id.exists' => 'Điểm khởi hành này không tồn tại!',
            'balance_id.required' => 'Chọn ngân sách!',
            'balance_id.exists' => 'Ngân sách này không tồn tại!',
        ];
    }
}
