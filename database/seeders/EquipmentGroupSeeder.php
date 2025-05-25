<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

final class EquipmentGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $equipmentGroup = [
            'Body Weight',
            'Bands',
            'Barbell',
            'Bench',
            'Dumbbell',
            'Ez Curl Bar',
            'Kettlebell',
            'Machine',
        ];

        foreach ($equipmentGroup as $group) {
            $slug = Str::slug($group);

            DB::table('equipment_groups')->insert([
                'title' => $group,
                'slug' => $slug,
                'icon_url' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
