<?php

namespace App\Http\Requests;

use App\Enums\Role;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateUserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'role' => ['required', Rule::in(Role::all())],

            'first_name' => 'required|string',
            'last_name' => 'required|string',

            'email' => 'required|email',
            'password' => 'required|string',
        ];
    }
}
