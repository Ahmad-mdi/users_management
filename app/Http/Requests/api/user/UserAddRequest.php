<?php

namespace App\Http\Requests\api\user;

use App\Rules\NationalCode;
use App\Traits\ApiValidation;
use Illuminate\Foundation\Http\FormRequest;

class UserAddRequest extends FormRequest
{
    use ApiValidation;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'firstname' => ['required', 'string'],
            'lastname' => ['required', 'string'],
            'username' => ['required', 'string', 'unique:users,username'],
            'nationalCode' => ['required', 'string', 'min:10', 'max:10', 'unique:users,nationalCode',new NationalCode()],
            'password' => ['required', 'min:6', 'regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[@#$%^&+=])(?=\\S+$).{8,}$/'],
        ];
    }
}
