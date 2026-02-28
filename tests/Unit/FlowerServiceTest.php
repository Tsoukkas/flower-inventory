<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Services\FlowerService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FlowerServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_creates_a_flower(): void
    {
        $category = Category::factory()->create(['name' => 'Test Category']);

        $service = app(FlowerService::class);

        $flower = $service->create([
            'category_id' => $category->id,
            'name' => 'Rose',
            'type' => 'Single stem',
            'price' => 5.50,
            'stock' => 10,
        ]);

        $this->assertDatabaseHas('flowers', [
            'id' => $flower->id,
            'name' => 'Rose',
            'category_id' => $category->id,
        ]);
    }
}