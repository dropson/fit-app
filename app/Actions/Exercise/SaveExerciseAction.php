<?php

declare(strict_types=1);

namespace App\Actions\Exercise;

use App\DTOs\ExerciseDTO;
use App\Enums\UserRoleEnum;
use App\Models\Exercise;
use Illuminate\Support\Facades\Auth;

final class SaveExerciseAction
{
    public function handle(ExerciseDTO $data, ?Exercise $exercise = null)
    {
        $user = Auth::user();

        $author = $user->hasRole(UserRoleEnum::MODERATOR->value)
            ? null
            : $user->id;

        if (!$exercise) {
            $exercise = new Exercise(['created_by' => $author]);
        }

        $exercise->fill([
            'title' => $data->title,
            'instruction' => $data->instruction,

            'equipment' => $data->equipment->value,
        ])->save();
        $exercise->muscleImpacts()->delete();
        foreach ($data->muscleImpacts as $impact) {
            $exercise->muscleImpacts()->create([
                'muscle_group' => $impact['muscle_group']->value,
                'impact_percent' => $impact['impact_percent'],
            ]);
        }

        return $exercise->fresh('muscleImpacts');
    }
}
