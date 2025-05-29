<?php

declare(strict_types=1);

namespace App\Actions\Workouts;

use App\Enums\UserRoleEnum;
use App\Models\User;
use App\Models\Workouts\TemplateExercise;
use App\Models\Workouts\TemplateSet;
use App\Models\Workouts\TemplateWorkout;
use App\Services\WorkoutDurationCalculator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

final class StoreTemplateAction
{
    public function handle(array $data): TemplateWorkout
    {
        $user = Auth::user();
        $client = isset($data['client_id']) ? User::find($data['client_id']) : null;
        $data['author_id'] = $user->id;
        if ($client instanceof User) {
            $data['client_id'] = $client->id;
        } elseif ($user->hasRole(UserRoleEnum::CLIENT->value)) {
            $data['client_id'] = $user->id;
        } else {
            $data['client_id'] = null;
        }


        return DB::transaction(function () use ($data) {
            $template = TemplateWorkout::create([
                'title' => $data['title'],
                'instruction' => $data['instruction'] ?? null,
                'duration' => 0, // тимчасово, перерахуємо після
                'order' => $data['order'],
                'is_public' => $data['is_public'] ?? false,
                'client_id' => $data['client_id'],
                'author_id' => $data['author_id'],
            ]);

            foreach ($data['exercises'] as $exercise) {
                $templateExercise = TemplateExercise::create([
                    'template_workout_id' => $template->id,
                    'exercise_id' => $exercise['exercise_id'],
                    // 'order' => $exercise['order'] ?? null,
                ]);

                foreach ($exercise['sets'] as $set) {
                    TemplateSet::create([
                        'template_exercise_id' => $templateExercise->id,
                        'set_number' => $set['set_number'],
                        'repetitions' => $set['repetitions'],
                        'weight' => $set['weight'],
                        // 'order' => $set['order'] ?? null,
                    ]);
                }
            }

            // Перерахунок тривалості
            // $template->load('exercises.sets');
            $calculator = new WorkoutDurationCalculator();
            $duration = $calculator->calculate($template);
            $template->update(['duration' => $duration]);
            return $template;
        });
    }
}
