<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Auth;

use App\Enums\UserRoleEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterUserRequest;
use App\Models\User;
use App\Traits\ApiResponses;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

final class RegisterController extends Controller
{
    use ApiResponses;

    public function __invoke(RegisterUserRequest $request): JsonResponse
    {
        $request->validated();

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'gender' => $request->gender,
            'email' => $request->email,
            'password' => Hash::make($request->string('password')),
        ]);

        $user->assignRole(UserRoleEnum::CLIENT->value);

        return $this->success('Account created successfully. Please verify your email.', [], 201);
    }
}
