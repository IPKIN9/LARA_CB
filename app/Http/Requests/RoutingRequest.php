<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoutingRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'type_route' => 'required',
            'message_response' => 'required|integer'
        ];
    }

    public function messages()
    {
        return [
            'required' => "This field can'not empity",
            'integer' => 'Type data is not support'
        ];
    }
}
