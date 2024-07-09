<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Example data
        $categories = [
            [
                'name' => 'Electronics',
                'description' => 'Category for electronic devices',
            ],
            [
                'name' => 'Clothing',
                'description' => 'Category for various types of clothing',
            ],
            [
                'name' => 'Books',
                'description' => 'Category for books of different genres',
            ],
            // Add more categories as needed
        ];

        // Insert data into the categories table
        foreach ($categories as $categoryData) {
            Category::create($categoryData);
        }
    }
}
