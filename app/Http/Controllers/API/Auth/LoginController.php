<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginUserRequest;
use App\Http\Resources\V1\ClientResource;
use App\Models\User;
use App\Traits\ApiResponses;
use Illuminate\Support\Facades\Auth;

final class LoginController extends Controller
{
    use ApiResponses;

    public function __invoke(LoginUserRequest $request): \Illuminate\Http\JsonResponse
    {
        $request->validated();

        if (! Auth::attempt($request->only('email', 'password'))) {
            return $this->error('Invalid credentials', 401);
        }

        $user = User::firstWhere('email', $request->email);

        return $this->ok(
            'Authenticated',
            [
                'token' => $user->createToken('auth-token')->plainTextToken,
                'user' => new ClientResource($user),
            ]
        );
    }
}
