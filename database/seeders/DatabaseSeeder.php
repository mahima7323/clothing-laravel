<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Subcategory;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Seed categories
        $menCategory = Category::create(['name' => 'Men']);
        $womenCategory = Category::create(['name' => 'Women']);
        $kidsCategory = Category::create(['name' => 'Kids']);

        // Seed subcategories for Men
        Subcategory::create(['name' => 'Kurta', 'category_id' => $menCategory->id]);
        Subcategory::create(['name' => 'T-Shirt', 'category_id' => $menCategory->id]);

        // Seed subcategories for Women
        Subcategory::create(['name' => 'Kurta', 'category_id' => $womenCategory->id]);
        Subcategory::create(['name' => 'T-Shirt', 'category_id' => $womenCategory->id]);

        // Seed subcategories for Kids
        Subcategory::create(['name' => 'Shirt', 'category_id' => $kidsCategory->id]);
        Subcategory::create(['name' => 'Pants', 'category_id' => $kidsCategory->id]);
    }
}

