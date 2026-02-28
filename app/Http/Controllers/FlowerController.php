<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFlowerRequest;
use App\Http\Requests\UpdateFlowerRequest;
use App\Services\CategoryService;
use App\Services\FlowerService;
use Illuminate\Http\Request;

class FlowerController extends Controller
{
    public function __construct(
    private FlowerService $flowerService,
    private CategoryService $categoryService
) {}

    public function index(Request $request)
    {
        $q = (string) $request->query('q', '');
        $sort = (string) $request->query('sort', 'name_asc');
        $categoryId = $request->query('category_id');

        $flowers = $this->flowerService->searchAndSort(
            q: $q,
            sort: $sort,
            categoryId: $categoryId ? (int) $categoryId : null,
            perPage: 10 // bonus pagination
        );

        $categories = $this->categoryService->all();

        return view('flowers.index', compact('flowers', 'q', 'sort', 'categories', 'categoryId'));
    }

    public function show(int $id)
    {
        $flower = $this->flowerService->getById($id);
        return view('flowers.show', compact('flower'));
    }

    public function create()
    {
        $categories = $this->categoryService->all();
        return view('flowers.create', compact('categories'));
    }

    public function store(StoreFlowerRequest $request)
    {
        $this->flowerService->create($request->validated(), $request);
        return redirect()->route('flowers.index')->with('success', 'Flower created successfully.');
    }

    public function edit(int $id)
    {
        $flower = $this->flowerService->getById($id);
        $categories = $this->categoryService->all();
        return view('flowers.edit', compact('flower', 'categories'));
    }

    public function update(UpdateFlowerRequest $request, int $id)
    {
        $this->flowerService->update($id, $request->validated(), $request);
        return redirect()->route('flowers.show', $id)->with('success', 'Flower updated successfully.');
    }

    public function delete(int $id)
    {
        $flower = $this->flowerService->getById($id);
        return view('flowers.delete', compact('flower'));
    }

    public function destroy(int $id)
    {
        $this->flowerService->delete($id);
        return redirect()->route('flowers.index')->with('success', 'Flower deleted successfully.');
    }
}