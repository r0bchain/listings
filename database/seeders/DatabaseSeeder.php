<?php

namespace Database\Seeders;

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

        \App\Models\Listing::factory(10)->create([
            'owner_id' => 1,
        ]);

        \App\Models\Listing::factory(10)->create([
            'owner_id' => 2,
        ]);
    }
}
