<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\EquipmentGroup;
use App\Models\MuscleGroup;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Exercise>
 */
final class ExerciseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $mainMuscle = MuscleGroup::inRandomOrder()->first();
        $secondaryMuscle = MuscleGroup::where('id', '!=', $mainMuscle->id)->inRandomOrder()->first();
        $equipment = EquipmentGroup::inRandomOrder()->first();

        return [
            'title' => rtrim(fake()->unique()->sentence(2), '.'),
            'instruction' => fake()->paragraph(),
            'equipment_group_id' => $equipment->id,
            'main_muscle_group_id' => $mainMuscle,
            'second_muscle_group_id' => random_int(0, 1) !== 0 ? $secondaryMuscle->id : null,
            'created_by' => null,
        ];
    }
}
