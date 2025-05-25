<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Exercise;
use Illuminate\Database\Seeder;

final class ExerciseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Exercise::factory()->count(30)->create();
    }
}
