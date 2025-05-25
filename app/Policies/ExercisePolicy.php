<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Exercise;
use App\Models\User;

final class ExercisePolicy
{
    public function view(User $user, Exercise $exercise): bool
    {
        return $exercise->created_by === $user->id;
    }

    public function update(User $user, Exercise $exercise): bool
    {
        return $this->view($user, $exercise);
    }

    public function delete(User $user, Exercise $exercise): bool
    {
        return $this->view($user, $exercise);
    }
}
