<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\UserRoleEnum;
use App\Models\Exercise;
use App\Models\User;
use App\Models\WorkoutItem;
use App\Models\Workouts\TemplateExercise;
use App\Models\Workouts\TemplateSet;
use App\Models\Workouts\TemplateWorkout;
use App\Models\WorkoutTemplate;
use App\Services\WorkoutDurationCalculator;
use Illuminate\Database\Seeder;

final class TemplateWorkoutSeeder extends Seeder
{
    public function run(): void
    {
        WorkoutTemplate::factory()->count(4)->create();
    }
}
