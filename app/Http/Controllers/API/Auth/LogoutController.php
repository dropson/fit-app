<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponses;
use Illuminate\Http\Request;

final class LogoutController extends Controller
{
    use ApiResponses;

    public function __invoke(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->user()->currentAccessToken()->delete();

        return $this->ok('');
    }
}
