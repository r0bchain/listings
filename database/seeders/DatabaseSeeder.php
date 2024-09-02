<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Listing;
use App\Models\Category;
use Illuminate\Support\Facades\Http;

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
      
        // Second add the parent categories to the database
        $categories = $this->get_categories(null);
        foreach($categories as $name => $category) {
            // dd($category);
            // Get image from endpoint
            Category::factory()->create([
                'name' => $name,
                'cover_image' => $category['cover_image'],
                'icon' => ($category['icon']) ?? 'fa-duotone fa-solid fa-house',
            ]);

        }

        $categoriesDb = Category::all();

        // Add the children categories to the database
        foreach($categoriesDb as $category) {
           
            $childrenCategories = $this->get_categories($category->name);
         
            if(!empty($childrenCategories)) {
                foreach($childrenCategories as $name => $children) {
                    // dd($children_name);
                    Category::factory()->create([
                        'name' => $name,
                        'parent_id' => $category->id,
                        'cover_image' => ($children['cover_image']) ?? $children,
                        'icon' => ($children['icon']) ?? 'fa-duotone fa-solid fa-house',
                    ]);    
                }
            }

            $childrenCategories = [];
            $newCategory = null;
            
        }

        Listing::factory(20)->create([
            'owner_id' => 11,
        ]);

        Listing::factory(30)->create([
            'owner_id' => 2,
        ]);

      

        
    }

    public function get_categories($categoryName = null): array
    {

        // Categories
        if(is_null($categoryName)) {
            return  [

                'Real State' => 
                ['cover_image' => 'https://images.pexels.com/photos/1154193/pexels-photo-1154193.jpeg?auto=compress&cs=tinysrgb&fit=crop&h=627&w=1200', 
                'icon' => 'fa-solid fa-building'],
                
                'Bussines for sell or rent' => 
                ['cover_image' => 'https://images.pexels.com/photos/7578876/pexels-photo-7578876.jpeg?auto=compress&cs=tinysrgb&fit=crop&h=627&w=1200',
                'icon' => 'fa-solid fa-city'], 

                'Cars & Vehicles' => [
                'cover_image' => 'https://images.pexels.com/photos/315938/pexels-photo-315938.jpeg?auto=compress&cs=tinysrgb&fit=crop&h=627&w=1200',
                'icon' => 'fa-sharp fa-solid fa-car-side'], 

                'Home $$ Furniture' => [
                'cover_image' => 'https://images.pexels.com/photos/20036266/pexels-photo-20036266.jpeg?auto=compress\u0026cs=tinysrgb\u0026fit=crop\u0026h=627\u0026w=1200',
                'icon' => 'fa-sharp fa-solid fa-couch'], 
                
                'Jobs' => 
                ['cover_image' => 'https://images.pexels.com/photos/392018/pexels-photo-392018.jpeg?auto=compress&cs=tinysrgb&fit=crop&h=627&w=1200', 
                'icon' => 'fa-sharp fa-solid fa-briefcase'],
                
                'Boats' => 
                ['cover_image' => 'https://images.pexels.com/photos/296242/pexels-photo-296242.jpeg?auto=compress&cs=tinysrgb&fit=crop&h=627&w=1200', 
                'icon' => 'fa-sharp fa-solid fa-ship'],
                
                'Services' => 
                ['cover_image' => 'https://images.pexels.com/photos/845451/pexels-photo-845451.jpeg?auto=compress&cs=tinysrgb&fit=crop&h=627&w=1200', 
                'icon' => 'fa-sharp fa-solid fa-tools'],
                
                'Sport equipment' => 
                ['cover_image' => 'https://images.pexels.com/photos/209977/pexels-photo-209977.jpeg?auto=compress\u0026cs=tinysrgb\u0026fit=crop\u0026h=627\u0026w=1200', 
                'icon' => 'fa-solid fa-person-swimming'],

                'Other' => 
                ['cover_image' => 'https://images.pexels.com/photos/3796810/pexels-photo-3796810.jpeg?auto=compress&cs=tinysrgb&fit=crop&h=627&w=1200',
                'icon' => 'fa-sharp fa-solid fa-question']
            ];
        }

        // Children categories
        $childrenCategory =[
            'Real State' => [
                'Houses' => 
                ['cover_image' => 'https://images.pexels.com/photos/27920274/pexels-photo-27920274.jpeg?auto=compress\u0026cs=tinysrgb\u0026fit=crop\u0026h=627\u0026w=1200',
                'icon' => 'fa-solid fa-house'],
                'Apartments' => ['cover_image' => 'https://images.pexels.com/photos/27920274/pexels-photo-27920274.jpeg?auto=compress\u0026cs=tinysrgb\u0026fit=crop\u0026h=1200\u0026w=800',
                'icon' => 'fa-solid fa-building'],
                'Commercial' => ['cover_image' => 'https://images.pexels.com/photos/534216/pexels-photo-534216.jpeg?auto=compress\u0026cs=tinysrgb\u0026fit=crop\u0026h=1200\u0026w=800',
                'icon' => 'fa-solid fa-shop'],
                'Land' => ['cover_image' => 'https://images.pexels.com/photos/27925072/pexels-photo-27925072.jpeg?auto=compress\u0026cs=tinysrgb\u0026fit=crop\u0026h=627\u0026w=1200',
                'icon' => 'fa-solid fa-mountain-sun'],
                'Garages' => ['cover_image' => 'https://images.pexels.com/photos/210617/pexels-photo-210617.jpeg?auto=compress\u0026cs=tinysrgb\u0026fit=crop\u0026h=627\u0026w=1200',
                'icon' => 'fa-solid fa-warehouse'],
                'Other' => ['cover_image' => 'https://images.pexels.com/photos/27920274/pexels-photo-27920274.jpeg?auto=compress\u0026cs=tinysrgb\u0026fit=crop\u0026h=627\u0026w=1200',
                'icon' => 'fa-solid fa-city'],
            ],
            'Bussines for sell or rent' => [
                'Restaurants' => ['cover_image' => 'https://images.pexels.com/photos/262978/pexels-photo-262978.jpeg?auto=compress\u0026cs=tinysrgb\u0026fit=crop\u0026h=627\u0026w=1200',
                'icon' => 'fa-solid fa-utensils'],
                'Shops' => ['cover_image' => 'https://images.pexels.com/photos/3056056/pexels-photo-3056056.jpeg?auto=compress\u0026cs=tinysrgb\u0026fit=crop\u0026h=1200\u0026w=800',
                'icon' => 'fa-solid fa-store'],
                'Offices' => ['cover_image' => 'https://images.pexels.com/photos/2448733/pexels-photo-2448733.jpeg?auto=compress\u0026cs=tinysrgb\u0026fit=crop\u0026h=627\u0026w=1200',
                'icon' => 'fa-solid fa-building'],
                'Warehouses' => ['cover_image' => 'https://images.pexels.com/photos/4464817/pexels-photo-4464817.jpeg?auto=compress\u0026cs=tinysrgb\u0026fit=crop\u0026h=627\u0026w=1200',
                'icon' => 'fa-solid fa-warehouse'],
                'Other' => ['cover_image' => 'https://images.pexels.com/photos/27925072/pexels-photo-27925072.jpeg?auto=compress\u0026cs=tinysrgb\u0026fit=crop\u0026h=627\u0026w=1200',
                'icon' => 'fa-solid fa-city'],
            ],
            'Cars & Vehicles' => [
                'Cars'  => ['cover_image' => 'https://images.pexels.com/photos/4005035/pexels-photo-4005035.jpeg?auto=compress\u0026cs=tinysrgb\u0026fit=crop\u0026h=627\u0026w=1200',
                'icon' => 'fa-solid fa-car-side'],
                'Motorcycles'  => ['cover_image' => 'https://images.pexels.com/photos/6249454/pexels-photo-6249454.jpeg?auto=compress\u0026cs=tinysrgb\u0026fit=crop\u0026h=627\u0026w=1200"',
                'icon' => 'fa-solid fa-motorcycle'],
                'Trucks' => ['cover_image' => 'https://images.pexels.com/photos/6161660/pexels-photo-6161660.jpeg?auto=compress\u0026cs=tinysrgb\u0026fit=crop\u0026h=627\u0026w=1200',
                'icon' => 'fa-solid fa-truck'],
                'Boats' => ['cover_image' => 'https://images.pexels.com/photos/2951696/pexels-photo-2951696.jpeg?auto=compress\u0026cs=tinysrgb\u0026fit=crop\u0026h=627\u0026w=1200',
                'icon' => 'fa-solid fa-ship'],
                'Other' => ['cover_image' => 'https://images.pexels.com/photos/3042377/pexels-photo-3042377.jpeg?auto=compress\u0026cs=tinysrgb\u0026fit=crop\u0026h=627\u0026w=1200',
                'icon' => 'fa-solid fa-car-side'],
            ],

            'Jobs' => [
                'Full time' => ['cover_image' => 'https://images.pexels.com/photos/5024217/pexels-photo-5024217.jpeg?auto=compress\u0026cs=tinysrgb\u0026fit=crop\u0026h=627\u0026w=1200',
                'icon' => 'fa-solid fa-person-digging'],
                'Part time' => ['cover_image' => 'https://images.pexels.com/photos/4021779/pexels-photo-4021779.jpeg?auto=compress\u0026cs=tinysrgb\u0026fit=crop\u0026h=627\u0026w=1200',
                'icon' => 'fa-solid fa-laptop-code'],
                'Freelance' => ['cover_image' => 'https://images.pexels.com/photos/5546874/pexels-photo-5546874.jpeg?auto=compress\u0026cs=tinysrgb\u0026fit=crop\u0026h=627\u0026w=1200',
                'icon' => 'fa-solid fa-user-tie'],
                'Internship' => ['cover_image' => 'https://images.pexels.com/photos/7688336/pexels-photo-7688336.jpeg?auto=compress\u0026cs=tinysrgb\u0026fit=crop\u0026h=627\u0026w=1200',
                'icon' => 'fa-solid fa-briefcase'],
                'Other' => ['cover_image' => 'https://images.pexels.com/photos/6755057/pexels-photo-6755057.jpeg?auto=compress\u0026cs=tinysrgb\u0026fit=crop\u0026h=627\u0026w=1200',
                'icon' => 'fa-solid fa-house-laptop'],
            ],
            'Boats' => [
                'Sailboats' => 'url',
                'Motorboats' => 'url',
                'Yachts' => 'url',
                'Other' => 'url',
            ],
            'Services' => [
                'Cleaning' => 'url',
                'Gardening' => 'url',
                'Plumbing' => 'url',
                'Electricity' => 'url',
                'Other' => 'url',
            ],
            'Sport equipment' => [
                'Bicycles' => 'url',
                'Skateboards' => 'url',
                'Surfboards' => 'url',
                'Other' => 'url',
            ],
            'Other' => [
                'Other' => 'url',
            ]
            

        ];

        return isset($childrenCategory[$categoryName]) ? $childrenCategory[$categoryName] : [];
    }

   
}
