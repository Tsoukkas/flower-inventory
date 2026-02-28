<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Flower;
use Illuminate\Database\Seeder;

class FlowerSeeder extends Seeder
{
    public function run(): void
    {
        Flower::query()->delete();

        $roses = Category::where('name', 'Roses')->firstOrFail();
        $seasonal = Category::where('name', 'Seasonal')->firstOrFail();

        Flower::create([
            'category_id' => $roses->id,
            'name' => 'Red Rose',
            'type' => 'Single stem',
            'price' => 3.50,
            'stock' => 120,
        ]);

        Flower::create([
            'category_id' => $roses->id,
            'name' => 'White Rose Bouquet',
            'type' => 'Bouquet',
            'price' => 24.99,
            'stock' => 25,
        ]);

        Flower::create([
            'category_id' => $seasonal->id,
            'name' => 'Tulip Mix',
            'type' => 'Bouquet',
            'price' => 19.90,
            'stock' => 40,
        ]);

        Flower::create([
            'category_id' => $seasonal->id,
            'name' => 'Sunflower',
            'type' => 'Single stem',
            'price' => 2.80,
            'stock' => 60,
        ]);
    }
}