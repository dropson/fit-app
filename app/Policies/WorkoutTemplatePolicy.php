<?php

namespace App\Policies;

use App\Models\User;
use App\Models\WorkoutTemplate;
use Illuminate\Auth\Access\Response;

class WorkoutTemplatePolicy
{
    public function view(User $user, WorkoutTemplate $templateWorkout): bool
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
