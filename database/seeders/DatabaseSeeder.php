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
            ExerciseSeeder::class,
        ]);

        $client = User::factory()->create([
            'first_name' => 'Client',
            'last_name' => 'Terry',
            'email' => 'client@example.com',
        ]);
        $client->assignRole(UserRoleEnum::CLIENT->value);

        $coach = User::factory()->create([
            'first_name' => 'Coach',
            'last_name' => 'Steroid',
            'email' => 'testosteron@example.com',
        ]);
        $coach->assignRole(UserRoleEnum::COACH->value);

        $moderator = User::factory()->create([
            'first_name' => 'Moderator',
            'last_name' => 'Hasan',
            'email' => 'moderator@example.com',
        ]);
        $moderator->assignRole(UserRoleEnum::MODERATOR->value);


        User::factory()->count(40)->create()->each(function ($user) {
            $role = collect([
                UserRoleEnum::CLIENT->value,
                UserRoleEnum::COACH->value,
            ])->random();

            $user->assignRole($role);
        });

        $this->call(TemplateWorkoutSeeder::class);
    }
}
