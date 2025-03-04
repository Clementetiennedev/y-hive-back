<?php

namespace Database\Seeders;

use App\Models\Apiary;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Hive;
use App\Models\Intervention;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::factory()->create([
            'first_name' => 'Test',
            'last_name' => 'the admin',
            'email' => 'admin@admin.fr',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        User::factory(10)->create();
        Apiary::factory(30)->create();
        Hive::factory(100)->create();

        Intervention::factory(100)->create();
    }
}
