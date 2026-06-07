<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Create Users
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@bulkbazaar.com',
            'password' => Hash::make('password'),
            'is_admin' => true,
        ]);

        User::create([
            'name' => 'Customer User',
            'email' => 'customer@bulkbazaar.com',
            'password' => Hash::make('password'),
            'is_admin' => false,
        ]);

        // Create categories
        $electronics = Category::create([
            'name' => 'Electronics',
            'description' => 'Premium gadgets, smartphones, laptops, and devices.',
            'image' => 'electronics.jpg',
            'status' => 'active'
        ]);

        $fashion = Category::create([
            'name' => 'Fashion',
            'description' => 'Stylish clothing, apparel, shoes, and accessories.',
            'image' => 'fashion.jpg',
            'status' => 'active'
        ]);

        $sports = Category::create([
            'name' => 'Sports',
            'description' => 'Fitness equipment, athletic gear, and outdoor activewear.',
            'image' => 'sports.jpg',
            'status' => 'active'
        ]);

        $books = Category::create([
            'name' => 'Books',
            'description' => 'Novels, biographies, literature, and educational textbooks.',
            'image' => 'books.jpg',
            'status' => 'active'
        ]);

        // Create products
        Product::create([
            'category_id' => $electronics->id,
            'name' => 'Smartphone Pro X12',
            'sku' => 'ELEC-SMP-X12',
            'brand' => 'Aura',
            'description' => 'Latest flagship smartphone featuring a 6.7-inch OLED screen, triple-camera system, and 5G connectivity.',
            'price' => 12999.00,
            'discount_price' => 11999.00,
            'stock' => 50,
            'status' => 'active',
            'tags' => 'smartphone,5g,oled,aura',
            'specifications' => json_encode([
                'Screen Size' => '6.7 inch OLED',
                'RAM' => '8 GB',
                'Storage' => '256 GB',
                'Battery' => '4500 mAh'
            ]),
            'image' => null
        ]);

        Product::create([
            'category_id' => $electronics->id,
            'name' => 'Laptop Ultra 15',
            'sku' => 'ELEC-LPT-U15',
            'brand' => 'Apex',
            'description' => 'High performance ultra-slim laptop with 16GB RAM, 512GB SSD storage, and Intel Core i7 processor.',
            'price' => 54999.00,
            'discount_price' => 49999.00,
            'stock' => 20,
            'status' => 'active',
            'tags' => 'laptop,i7,ssd,workplace',
            'specifications' => json_encode([
                'Processor' => 'Intel Core i7 13th Gen',
                'RAM' => '16 GB DDR5',
                'Storage' => '512 GB NVMe SSD',
                'Display' => '15.6 inch IPS FHD'
            ]),
            'image' => null
        ]);

        Product::create([
            'category_id' => $fashion->id,
            'name' => 'Stylish T-Shirt',
            'sku' => 'FASH-TSH-ST1',
            'brand' => 'Vibe',
            'description' => 'Comfortable and premium 100% organic cotton t-shirt designed for everyday modern style.',
            'price' => 999.00,
            'discount_price' => 799.00,
            'stock' => 100,
            'status' => 'active',
            'tags' => 'tshirt,cotton,organic,casual',
            'specifications' => json_encode([
                'Material' => '100% Organic Cotton',
                'Color' => 'Midnight Black',
                'Fit' => 'Regular Fit',
                'Size' => 'M, L, XL'
            ]),
            'image' => null
        ]);

        Product::create([
            'category_id' => $sports->id,
            'name' => 'Premium Soccer Ball',
            'sku' => 'SPRT-SOC-BALL',
            'brand' => 'Goal',
            'description' => 'Standard Size 5 soccer ball with high-durability stitching and optimal air retention.',
            'price' => 1499.00,
            'discount_price' => 1299.00,
            'stock' => 40,
            'status' => 'active',
            'tags' => 'soccer,football,ball,goal',
            'specifications' => json_encode([
                'Size' => 'Size 5',
                'Material' => 'Polyurethane (PU)',
                'Stitching' => 'Hand-stitched',
                'Weight' => '420g'
            ]),
            'image' => null
        ]);
    }
}