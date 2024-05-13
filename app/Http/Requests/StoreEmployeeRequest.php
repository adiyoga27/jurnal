<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
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
            'kode_karyawan' =>'required',
            'nama_karyawan' =>'required',
            'hp' =>'required',
            'tgl_lahir' =>'required',
            'tgl_gabung' =>'required',
            'alamat' =>'required',
            'photo' =>'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
        ];
    }
}
