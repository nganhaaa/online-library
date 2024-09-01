<?php

namespace Database\Seeders;

use App\Models\AgeGroup;
use App\Models\Author;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);


        User::factory()->create([
            'id' => 1,
            'name' => 'Zura',
            'email' => 'zura@example.com',
            'password' => bcrypt('123.321A'),
            'email_verified_at' => time()
        ]);
        User::factory()->create([
            'id' => 2,
            'name' => 'John Smith',
            'email' => 'john@example.com',
            'password' => bcrypt('123.321A'),
            'email_verified_at' => time()
        ]);

        AgeGroup::factory();

    }
}
