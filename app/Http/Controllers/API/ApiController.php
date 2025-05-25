<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponses;
use Illuminate\Auth\Access\AuthorizationException;

abstract class ApiController extends Controller
{
    use ApiResponses;

    protected $policyClass;

    public function isAble($ability, $targetModel): bool
    {
        try {
            $this->authorize($ability, [$targetModel, $this->policyClass]);

            return true;
        } catch (AuthorizationException) {
            return false;
        }
    }
}
