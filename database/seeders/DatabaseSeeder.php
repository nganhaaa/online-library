<?php

namespace Database\Seeders;

use App\Models\AgeGroup;
use App\Models\Author;
use App\Models\Book;
use App\Models\Genre;
use App\Models\Publisher;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::transaction(function () {
            try {
                // Seed users
                User::factory(10)->create();
                
                // Seed age groups
                AgeGroup::factory()->create([
                    'id' => 1,
                    'name' => 'Child',
                    'min_age' => 0,
                    'max_age' => 12,
                ]);
                AgeGroup::factory()->create([
                    'id' => 2,
                    'name' => 'Teen',
                    'min_age' => 13,
                    'max_age' => 17,
                ]);
                AgeGroup::factory()->create([
                    'id' => 3,
                    'name' => 'Young Adult',
                    'min_age' => 18,
                    'max_age' => 25,
                ]);
                AgeGroup::factory()->create([
                    'id' => 4,
                    'name' => 'Adult',
                    'min_age' => 26,
                    'max_age' => 64,
                ]);
                AgeGroup::factory()->create([
                    'id' => 5,
                    'name' => 'Senior',
                    'min_age' => 65,
                    'max_age' => 120,
                ]);

                // Seed authors
                Author::factory(10)->create();
                
                // Seed genres
                Genre::factory(10)->create();
                
                Publisher::factory(10)->create();
                // Seed books
                Book::factory(50)->create();
            } catch (\Exception $e) {
                // Log the error and rethrow it to trigger rollback
                Log::error('Database seeding failed: '.$e->getMessage());
                throw $e;
            }
        });
    }
}
