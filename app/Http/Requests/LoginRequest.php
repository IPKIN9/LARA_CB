<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'username' => 'required|min:5|max:12',
            'password' => 'required|min:5|max:12|confirmed',
        ];
    }
    public function messages()
    {
        return[
            'required' => 'field ini tidak boleh kosong',
            'min' => 'Isi field terlalu pendek',
            'max' => 'Isi field terlalu panjang',
            'confirmed' => 'Password tidak sama'
        ];
    }
}
