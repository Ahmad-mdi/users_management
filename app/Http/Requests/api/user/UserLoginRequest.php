<?php

namespace App\Http\Requests\api\user;

use App\Traits\ApiValidation;
use Illuminate\Foundation\Http\FormRequest;

class UserLoginRequest extends FormRequest
{
    use ApiValidation;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'username' => 'required|exists:users,username',
            'password' => 'required|min:6'
        ];
    }
}
