<?php

namespace App\Services\Contracts;

use Illuminate\Support\Collection;

interface CategoryServiceInterface
{
    public function all(): Collection;
}