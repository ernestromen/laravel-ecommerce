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
        $products = [
            [
                'name' => 'Product 1',
                'description' => 'Description of Product 1',
                'price' => 29.99,
                'sku' => 'PROD1',
                'quantity' => 100,
                'weight' => 1.5,
                'category_id' => 1
            ],
            [
                'name' => 'Product 2',
                'description' => 'Description of Product 2',
                'price' => 39.99,
                'sku' => 'PROD2',
                'quantity' => 50,
                'weight' => 2.0,
                'category_id' => 1
            ],
            [
                'name' => 'Product 3',
                'description' => 'Description of Product 3',
                'price' => 49.99,
                'sku' => 'PROD3',
                'quantity' => 75,
                'weight' => 1.2,
                'category_id' => 1
            ],
            [
                'name' => 'Product 4',
                'description' => 'Description of Product 4',
                'price' => 59.99,
                'sku' => 'PROD4',
                'quantity' => 80,
                'weight' => 1.8,
                'category_id' => 2
            ],
            [
                'name' => 'Product 5',
                'description' => 'Description of Product 5',
                'price' => 69.99,
                'sku' => 'PROD5',
                'quantity' => 60,
                'weight' => 2.5,
                'category_id' => 2
            ],
            [
                'name' => 'Product 6',
                'description' => 'Description of Product 6',
                'price' => 79.99,
                'sku' => 'PROD6',
                'quantity' => 90,
                'weight' => 2.2,
                'category_id' => 2
            ],
            [
                'name' => 'Product 7',
                'description' => 'Description of Product 7',
                'price' => 89.99,
                'sku' => 'PROD7',
                'quantity' => 40,
                'weight' => 1.6,
                'category_id' => 3
            ],
            [
                'name' => 'Product 8',
                'description' => 'Description of Product 8',
                'price' => 99.99,
                'sku' => 'PROD8',
                'quantity' => 30,
                'weight' => 2.8,
                'category_id' => 3
            ],
            [
                'name' => 'Product 9',
                'description' => 'Description of Product 9',
                'price' => 109.99,
                'sku' => 'PROD9',
                'quantity' => 20,
                'weight' => 3.0,
                'category_id' => 3
            ],
        ];

        foreach ($products as $productData) {
            Product::create($productData);
        }
    }
}

