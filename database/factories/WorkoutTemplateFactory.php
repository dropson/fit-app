<?php

namespace Database\Factories;

use App\Models\Exercise;
use App\Models\WorkoutTemplate;
use App\Services\WorkoutDurationCalculator;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WorkoutTemplate>
 */
class WorkoutTemplateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => 'Template ' . fake()->unique()->sentence(3),
            'instruction' => fake()->paragraph(),
            'author_id' => rand(1, 2)
        ];
    }
    public function configure(): static
    {
        return $this->afterCreating(function (WorkoutTemplate $template) {
            $exerciseCount = rand(4, 7);
            $exercises = Exercise::inRandomOrder()->limit($exerciseCount)->get();

            foreach ($exercises as $exercise) {
                $sets = rand(3, 5);

                for ($i = 1; $i <= $sets; $i++) {
                    $template->items()->create([
                        'exercise_id' => $exercise->id,
                        'set_number' => $i,
                        'repetitions' => rand(10, 15),
                        'weight' => rand(50, 130)
                    ]);
                }
            }

            $duration = app(WorkoutDurationCalculator::class)->calculate($template);
            $template->update(['duration' => $duration]);
        });
    }
}
