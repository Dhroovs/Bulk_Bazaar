<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Create categories
        $electronics = Category::create(['name' => 'Electronics']);
        $fashion = Category::create(['name' => 'Fashion']);

        // Create products
        Product::create([
            'category_id' => $electronics->id,
            'name' => 'Smartphone Pro X12',
            'description' => 'Latest smartphone with great features',
            'price' => 12999,
            'stock' => 50,
            'image' => 'phone.jpg'
        ]);

        Product::create([
            'category_id' => $electronics->id,
            'name' => 'Laptop Ultra 15',
            'description' => 'High performance laptop',
            'price' => 54999,
            'stock' => 20,
            'image' => 'laptop.jpg'
        ]);

        Product::create([
            'category_id' => $fashion->id,
            'name' => 'Stylish T-Shirt',
            'description' => 'Comfortable cotton t-shirt',
            'price' => 999,
            'stock' => 100,
            'image' => 'tshirt.jpg'
        ]);
    }
}