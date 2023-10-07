<?php

namespace App\Http\Controllers\Categorization;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Store;
use App\Repository\Categorization\Category\CategoryRepositoryInterface;

class CategoryController extends Controller
{

    protected $categoryRepository;
    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {
        return successResponse($this->categoryRepository->getAllCategories());
    }

    public function store(StoreCategoryRequest $request, Store $store)
    {
        return successMessage($this->categoryRepository->create($request, $store));
    }

    public function show(Category $category)
    {
        return successResponse($this->categoryRepository->getCategoryById($category));
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        return successResponse($this->categoryRepository->update($category, $request));
    }

    public function destroy(Category $category)
    {
        $this->categoryRepository->deleteCategory($category);
        return successMessage('deleted success');
    }
}
