<?php

declare(strict_types=1);

namespace App\Http\Requests\Auth;

use App\Enums\UserGenderEnum;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Validation\Rules\Password;

final class RegisterUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'min:2', 'max:20'],
            'last_name' => ['required', 'string', 'min:2', 'max:20'],
            'gender' => ['required', new Enum(UserGenderEnum::class)],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Password::defaults()],
        ];
    }
}
