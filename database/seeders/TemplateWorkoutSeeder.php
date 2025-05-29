<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\UserRoleEnum;
use App\Models\Exercise;
use App\Models\User;
use App\Models\Workouts\TemplateExercise;
use App\Models\Workouts\TemplateSet;
use App\Models\Workouts\TemplateWorkout;
use Illuminate\Database\Seeder;

final class TemplateWorkoutSeeder extends Seeder
{
    public function run(): void
    {
        $client = User::whereHas('roles', fn ($q) => $q->where('name', UserRoleEnum::CLIENT->value))->first();
        $coach = User::whereHas('roles', fn ($q) => $q->where('name', UserRoleEnum::COACH->value))->first();

        $exercises = Exercise::inRandomOrder()->take(3)->pluck('id');
        $coachWorkout = TemplateWorkout::create([
            'title' => 'Coach Template Workout',
            'author_id' => $coach->id,
            'client_id' => null,
            'duration' => 45,
            'order' => 1,
            'is_public' => true,
            'instruction' => 'Coach template workout instructions.',
        ]);

        $this->attachExercisesAndSets($coachWorkout->id, $exercises);

        $clientWorkout = TemplateWorkout::create([
            'title' => 'Client Template Workout',
            'author_id' => $client->id,
            'client_id' => $client->id,
            'duration' => 40,
            'order' => 1,
            'is_public' => true,
            'instruction' => 'Client template workout instructions.',
        ]);

        $this->attachExercisesAndSets($clientWorkout->id, $exercises);
    }

    private function attachExercisesAndSets(int $workoutId, $exerciseIds): void
    {
        $order = 1;

        foreach ($exerciseIds as $exerciseId) {
            $templateExercise = TemplateExercise::create([
                'template_workout_id' => $workoutId,
                'exercise_id' => $exerciseId,
                'order' => $order++,
            ]);

            for ($i = 1; $i <= 3; $i++) {
                TemplateSet::create([
                    'template_exercise_id' => $templateExercise->id,
                    'set_number' => $i,
                    'repetitions' => random_int(10, 15),
                    'weight' => random_int(30, 60),
                    'order' => $i,
                ]);
            }
        }
    }
}
