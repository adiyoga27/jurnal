<?php

namespace App\Http\Requests\Akun;

use Illuminate\Foundation\Http\FormRequest;

class AkunStoreRequest extends FormRequest
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
            'kode_akun' => 'required|unique:akun',
            'nama_akun' => 'required',
            'kategori_akun' => 'required',
        ];
    }
    
}
