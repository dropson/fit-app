<?php

declare(strict_types=1);

namespace App\Actions\Exercise;

use App\Enums\UserRoleEnum;
use App\Models\Exercise;
use Illuminate\Support\Facades\Auth;

final class StoreExerciseAction
{
    public function handle(array $data)
    {
        $user = Auth::user();

        $data['created_by'] = $user->hasRole(UserRoleEnum::MODERATOR->value)
            ? null
            : $user->id;

        return Exercise::create($data);
    }
}
