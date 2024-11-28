<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Location;
use App\Models\Product;
use App\Models\StockMovement;
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

        User::factory()->count(5)->create();

        $Categories = Category::factory()->count(5)->create();

        $Categories->for(function ($Category) {
            Product::factory()->count(2)->create([
                'category_id' => $Category->id
            ]);
        });

        StockMovement::factory();

        Location::factory()->count(3)->create();

    }
}
