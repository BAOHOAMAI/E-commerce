<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name'=>'required|max:50',
            'price'=>'required|integer|min:0',
            'category'=>'required',
            'brand'=>'required',
            'company'=>'required',
            'salee'=>'min:0',
            'image*'=>'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }
    public function messages() {
        return [
            'required'=>':attribute không được để trống',
            'integer'=>':attribute phải là một số',
            'min'=>':attribute không được dưới :min',
            'max'=>':attribute không được quá :max ký tự',
            'image'=>':attribute phải là định dạng hình ảnh',
            'mimes'=>':attribute phải có định dạng jpeg,png,jpg,gif,svg',
            'max'=>':attribute phải dưới 1Mb'
        ];
    }
    public function attributes(){
        return[
            'name'=>'Tên sản phẩm',
            'price'=>'Giá sản phẩm',
            'category'=>'Loại sản phẩm',
            'brand'=>'Hãng sản phẩm',
            'company'=>'Tên công ty',
            'image'=>'Hình sản phẩm',

            ];
    }
}
