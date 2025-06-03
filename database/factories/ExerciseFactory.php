<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\EquipmentEnum;
use App\Enums\MuscleGroupEnum;
use App\Models\Exercise;
use App\Models\ExerciseMuscleImpact;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Exercise>
 */
final class ExerciseFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => fake()->unique()->sentence(3),
            'instruction' => fake()->sentence(10),
            'visibility' => true,
            'equipment' => fake()->randomElement(EquipmentEnum::cases()),
            'created_by' => null,
        ];
    }

    public function configure(): static
    {
        return $this->afterCreating(function (Exercise $exercise): void {
            $muscules = collect(MuscleGroupEnum::cases())->random(random_int(2, 4));

            foreach ($muscules as $muscule) {
                ExerciseMuscleImpact::create([
                    'exercise_id' => $exercise->id,
                    'muscle_group' => $muscule,
                    'impact_percent' => random_int(30, 100),
                ]);
            }

        });
    }
}
