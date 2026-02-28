<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::query()->delete();

        Category::create(['name' => 'Roses', 'description' => 'Rose varieties']);
        Category::create(['name' => 'Seasonal', 'description' => 'Seasonal flowers']);
    }
}