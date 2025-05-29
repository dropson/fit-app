<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\UserRoleEnum;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

final class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            RolesAndPermissionSeeder::class,
            MuscleGroupSeeder::class,
            EquipmentGroupSeeder::class,
            ExerciseSeeder::class,
        ]);

        $client = User::factory()->create([
            'first_name' => 'Client',
            'last_name' => 'User',
            'email' => 'client@example.com',
        ]);
        $client->assignRole(UserRoleEnum::CLIENT->value);

        $coach = User::factory()->create([
            'first_name' => 'Coach',
            'last_name' => 'Steroid',
            'email' => 'testosteron@example.com',
        ]);
        $coach->assignRole(UserRoleEnum::COACH->value);

        $this->call(TemplateWorkoutSeeder::class);
    }
}
