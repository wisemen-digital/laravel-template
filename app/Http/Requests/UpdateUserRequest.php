<?php

namespace App\Http\Requests;

use App\Enums\Role;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'role' => ['sometimes', Rule::in(Role::all())],

            'first_name' => 'sometimes|string',
            'last_name' => 'sometimes|string',

            'email' => 'sometimes|email',
            'password' => 'sometimes|string',
        ];
    }
}
