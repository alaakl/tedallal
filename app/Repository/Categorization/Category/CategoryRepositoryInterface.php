<?php
namespace App\Repository\Categorization\Category;

use App\Models\Category;
use App\Models\Store;

interface CategoryRepositoryInterface {
    public function getAllCategories();

    public function getCategoryById(Category $category);

    public function create($collection, Store $store);

    public function update( Category $category, $collection);

    public function deleteCategory(Category $category);
}
