<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserDetailRequest extends FormRequest
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
            'enrollment'=>[
                'required',
                'string',
                'max:255',
                'min:6'
            ],
            'position'=>[
                'required',
                'string',
                'max:255',
                'min:6'
            ],
            'bithdate'=>[
                'required',
                'date',
                'before:today',
                'after:1900-01-01'
            ]
        ];
    }
}
