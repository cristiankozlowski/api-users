<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormRequestUser extends FormRequest
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
        switch ($this->method()) {
            case 'POST':
                return [
                    'name'     => 'required',
                    'email'    => 'required|unique:users,email',
                    'password' => 'required|min:6',
                ];
                break;
            case 'PUT':
                return [
                    'name'     => 'required',
                    'email'    => "required|unique:users,email,{$this->uuid}",
                    'password' => 'required|min:6',
                ];
                break;
        }
    }
}
