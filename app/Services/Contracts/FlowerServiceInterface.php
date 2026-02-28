<?php

namespace App\Services\Contracts;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface FlowerServiceInterface
{
    public function getById(int $id);
    public function searchAndSort(string $q, string $sort, ?int $categoryId, int $perPage = 10): LengthAwarePaginator;
    public function create(array $data, $request = null);
    public function update(int $id, array $data, $request = null);
    public function delete(int $id): void;
}