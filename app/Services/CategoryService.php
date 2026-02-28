<?php

namespace App\Services;

use App\Models\Category;
use App\Services\Contracts\CategoryServiceInterface;
use Illuminate\Support\Collection;

class CategoryService implements CategoryServiceInterface
{
    public function all(): Collection
    {
        return Category::query()->orderBy('name')->get();
    }
}