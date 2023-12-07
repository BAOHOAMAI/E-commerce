<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
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
            'title'=>'required|max:50',
            'description'=>'required|max:1000',
            'content'=>'required|max:1000',
            'image'=>'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }
    public function messages() {
        return [
            'required'=>':attribute không được để trống',
            'max'=>':attribute không được quá :max ký tự',
            'image'=>':attribute phải là hình ảnh',
            'email'=>':attribute phải có dạng xx@yy',
            'mimes'=>':attribute phải có định dạng jpeg,png,jpg,gif,svg',
        ];
    }

}
