<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Listing;
use App\Models\Category;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'is_admin' => true,
        ]);

        User::factory()->create([
            'name' => 'Admin 2 User',
            'email' => 'admin2@example.com',
            'is_admin' => true,

        ]);

        Listing::factory(10)->create([
            'owner_id' => 1,
        ]);

        Listing::factory(10)->create([
            'owner_id' => 2,
        ]);

        Category::factory(10)->create();
        Category::factory(2)->create([
            'parent_id' => 1
        ]);
        Category::factory(2)->create([
            'parent_id' => 2
        ]);
        Category::factory(2)->create([
            'parent_id' => 3
        ]);
        Category::factory(2)->create([
            'parent_id' => 4
        ]);

        
    }
}
