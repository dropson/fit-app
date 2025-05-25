<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

final class MuscleGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $muscleGroup = [
            'Back',
            'Biceps',
            'Chest',
            'Shoulder',
            'Triceps',
            'Core',
            'Legs',
        ];

        foreach ($muscleGroup as $group) {
            $slug = Str::slug($group);
            DB::table('muscle_groups')->insert([
                'title' => $group,
                'slug' => $slug,
                'icon_url' => url("images/muscle_groups/{$slug}.png"),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
