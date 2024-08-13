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
            'owner_id' => 11,
        ]);

        Listing::factory(10)->create([
            'owner_id' => 2,
        ]);

        // First add the parent categories to the database
        $categories = $this->get_categories(null);
        foreach($categories as $category) {
            Category::factory()->create([
                'name' => $category
            ]);

        }

        $categoriesDb = Category::all();

        // Add the children categories to the database
        foreach($categoriesDb as $category) {
            $newCategory = Category::factory()->create([
                'name' => $category
            ]);

            $childrenCategories = $this->get_categories($newCategory->name);
 
            foreach($childrenCategories as $children) {
                foreach( $children as $children_categories) {

                    Category::factory()->create([
                        'name' => $children_categories,
                        'parent_id' => $newCategory->id
                    ]);
                }
            }

            $childrenCategories = [];
            $newCategory = null;
            
        }
      

        
    }

    public function get_categories($categoryName = null): array
    {

        // Categories
        if(is_null($categoryName)) {
            return [
                'Real State',
                'Bussines for sell or rent',
                'Cars & Vehicles',
                'Jobs',
                'Boats',
                'Services',
                'Sport equipment',
                'Other'
            ];
        }

        // Children categories
        return [
            'Real State' => [
                'Houses',
                'Apartments',
                'Commercial',
                'Land',
                'Garages',
                'Other'
            ],
            'Bussines for sell or rent' => [
                'Restaurants',
                'Shops',
                'Offices',
                'Warehouses',
                'Other'
            ],
            'Cars & Vehicles' => [
                'Cars',
                'Motorcycles',
                'Trucks',
                'Boats',
                'Other'
            ],

            'Jobs' => [
                'Full time',
                'Part time',
                'Freelance',
                'Internship',
                'Other'
            ],
            'Boats' => [
                'Sailboats',
                'Motorboats',
                'Yachts',
                'Other'
            ],
            'Services' => [
                'Cleaning',
                'Gardening',
                'Plumbing',
                'Electricity',
                'Other'
            ],
            'Sport equipment' => [
                'Bicycles',
                'Skateboards',
                'Surfboards',
                'Other'
            ],
            'Other' => [
                'Other'
            ]
            

        ];
    }
}
