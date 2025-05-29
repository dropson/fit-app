<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\User;
use App\Models\Workouts\TemplateWorkout;

final class TemplateWorkoutPolicy
{
    public function view(User $user, TemplateWorkout $templateWorkout): bool
    {
        return $templateWorkout->author_id === $user->id;
    }

    public function update(): bool
    {
        return false;
    }

    public function delete(): bool
    {
        return false;
    }
}
