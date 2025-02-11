<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesSeeder extends Seeder
{
    public function run()
{
    $categories = [
        ['name' => 'Clothing'],
        ['name' => 'Shoes'],
        ['name' => 'Jewelry'],
        ['name' => 'Sports'],
        ['name' => 'Outdoors'],
        ['name' => 'Automotive'],
        ['name' => 'Industrial'],
        ['name' => 'Health'],
        ['name' => 'Beauty'],
        ['name' => 'Grocery'],
        ['name' => 'Pet'],
        ['name' => 'Baby'],
        ['name' => 'Toys'],
        ['name' => 'Office'],
        ['name' => 'Tools'],
        ['name' => 'Software'],
        ['name' => 'Digital'],
        ['name' => 'Services'],
        ['name' => 'Other'],
    ];

    foreach ($categories as $category) {
        Category::create($category);
    }
}
}