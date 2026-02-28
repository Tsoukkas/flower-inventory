<?php

namespace App\Services;

use App\Models\Flower;
use App\Services\Contracts\FlowerServiceInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class FlowerService implements FlowerServiceInterface
{
    public function getById(int $id): Flower
    {
        return Flower::query()->with('category')->findOrFail($id);
    }

    public function searchAndSort(string $q, string $sort, ?int $categoryId, int $perPage = 10): LengthAwarePaginator
    {
        $query = Flower::query()->with('category');

        if ($q !== '') {
            $query->where(function ($w) use ($q) {
                $w->where('name', 'like', "%{$q}%")
                  ->orWhere('type', 'like', "%{$q}%");
            });
        }

        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }

        [$col, $dir] = match ($sort) {
            'price_asc' => ['price', 'asc'],
            'price_desc' => ['price', 'desc'],
            'stock_asc' => ['stock', 'asc'],
            'stock_desc' => ['stock', 'desc'],
            'name_desc' => ['name', 'desc'],
            default => ['name', 'asc'],
        };

        return $query->orderBy($col, $dir)->paginate($perPage)->withQueryString();
    }

    public function create(array $data, $request = null): Flower
    {
        $data = $this->handleImageUpload($data, $request);

        try {
            return Flower::create($data);
        } catch (\Throwable $e) {
            Log::error('Failed to create flower', ['error' => $e->getMessage()]);
            throw $e;
        }
    }

    public function update(int $id, array $data, $request = null): Flower
    {
        $flower = $this->getById($id);

        $data = $this->handleImageUpload($data, $request, $flower);

        try {
            $flower->update($data);
            return $flower->fresh(['category']);
        } catch (\Throwable $e) {
            Log::error('Failed to update flower', ['id' => $id, 'error' => $e->getMessage()]);
            throw $e;
        }
    }

    public function delete(int $id): void
    {
        try {
            $flower = $this->getById($id);

            if ($flower->image_path) {
                Storage::disk('public')->delete($flower->image_path);
            }

            $flower->delete();
        } catch (ModelNotFoundException $e) {
            // no-op ή throw, ανάλογα τι θες
            throw $e;
        } catch (\Throwable $e) {
            Log::error('Failed to delete flower', ['id' => $id, 'error' => $e->getMessage()]);
            throw $e;
        }
    }

    private function handleImageUpload(array $data, $request, ?Flower $existing = null): array
    {
        if ($request instanceof Request && $request->hasFile('image')) {
            if ($existing?->image_path) {
                Storage::disk('public')->delete($existing->image_path);
            }
            $path = $request->file('image')->store('flowers', 'public');
            $data['image_path'] = $path;
        }

        return $data;
    }
}