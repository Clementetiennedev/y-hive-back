<?php

namespace Database\Seeders;

use App\Models\Apiary;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Hive;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'first_name' => 'Test',
            'last_name' => 'the admin',
            'email' => 'admin@admin',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        Apiary::factory(30)->create();
        Hive::factory(100)->create();
    }
}
