<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'user_id'=>'required|exists:users,id',
            'phone'=>'required|string',
            'email'=>'nullable|string|btween:3,50',
            'pio'=>'nullable|string',
            'image'=>'nullable|image|mimes:jpg,gif,png|max:2048'
        ];
    }
}
