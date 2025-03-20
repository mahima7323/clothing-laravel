<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Subcategory;

class SubcategorySeeder extends Seeder
{
    public function run()
    {
        // Subcategories for Men, Women, and Kids
        $menCategory = Category::where('name', 'Men')->first();
        $womenCategory = Category::where('name', 'Women')->first();
        $kidsCategory = Category::where('name', 'Kids')->first();

        // Debugging output to check if categories exist
        if ($menCategory) {
            echo "Men category found\n";
        } else {
            echo "Men category not found\n";
        }

        if ($womenCategory) {
            echo "Women category found\n";
        } else {
            echo "Women category not found\n";
        }

        if ($kidsCategory) {
            echo "Kids category found\n";
        } else {
            echo "Kids category not found\n";
        }

        // Adding subcategories for Men
        if ($menCategory) {
            $menCategory->subcategories()->createMany([
                ['name' => 'Kurta'],
                ['name' => 'T-Shirt'],
                ['name' => 'Shirt'],
            ]);
        }

        // Adding subcategories for Women
        if ($womenCategory) {
            $womenCategory->subcategories()->createMany([
                ['name' => 'Dress'],
                ['name' => 'Tops'],
                ['name' => 'Skirt'],
            ]);
        }

        // Adding subcategories for Kids
        if ($kidsCategory) {
            $kidsCategory->subcategories()->createMany([
                ['name' => 'T-Shirt'],
                ['name' => 'Jeans'],
                ['name' => 'Shorts'],
            ]);
        }
    }
}
