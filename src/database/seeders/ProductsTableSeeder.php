<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Example data
        $products = [
            [
                'name' => 'Product 1',
                'description' => 'Description of Product 1',
                'price' => 29.99,
                'sku' => 'PROD1',
                'quantity' => 100,
                'weight' => 1.5,
                'category_id' => 1,
            ],
            [
                'name' => 'Product 2',
                'description' => 'Description of Product 2',
                'price' => 39.99,
                'sku' => 'PROD2',
                'quantity' => 50,
                'weight' => 2.0,
                'category_id' => 2,
            ],
            // Add more products as needed
        ];

        // Insert data into the products table
        foreach ($products as $productData) {
            Product::create($productData);
        }
    }
}

