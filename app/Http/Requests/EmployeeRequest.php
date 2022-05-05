<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'employeeName' => 'required|min:10',
            'employeeCode' => 'required',
            'gender' => 'integer',
            'birthday' => 'required',
            'address' => 'required',
            'phongban_id' => 'integer',
            'bangcap_id' => 'integer',
            'imageEmployee' => 'required|image|max:2048'
        ];
    }

    public function messages()
    {
        return [
            'employeeName.required' => 'Tên không được để trống!',
            'employeeName.min' => 'Tên không được dưới 10 ký tự!',
            'employeeCode.required' => 'Mã nhân viên không được để trống!',
            'gender.integer' => 'Vui lòng chọn giới tính!',
            'birthday.required' => 'Vui lòng chọn ngày sinh!',
            'address.required' => 'Địa chỉ không được để trống!',
            'phongban_id.integer' => 'Vui lòng chọn phòng ban!',
            'bangcap_id.integer' => 'Vui lòng chọn bằng cấp!',
            'imageEmployee.required' => 'Hình ảnh không được để trống!',
            'imageEmployee.image' => 'Hình ảnh không đúng định dạng!',
            'imageEmployee.max' => 'Kích thước hình ảnh vượt quá 2048KB!',
        ];
    }
}
