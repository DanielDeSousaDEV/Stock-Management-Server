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

        $Categories->map(function (Category $Category) {
            $Products = Product::factory()->count(2)->create([
                'category_id' => $Category->id
            ]);
            // dd($Products);

            $Locations = Location::factory()->count(2)->create();

            $Locations->map(function (Location $Location, int $index) use($Products) {
                StockMovement::factory()->count(2)->create([
                    'product_id' => $Products[$index]->id,
                    'location_id' => $Location->id
                ]);
                
            });
        });



    }
}
