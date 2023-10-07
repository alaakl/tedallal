<?php

namespace App\Repository\Categorization\Category;

use App\Models\Category;
use App\Models\Store;
use App\Traits\GeneralTrait;

class CategoryRepository implements CategoryRepositoryInterface
{
    use GeneralTrait;
    public function getAllCategories()
    {
        return Category::query()->get();
    }

    public function getCategoryById(Category $category)
    {
        return $category->types()->paginate(100);
    }

    public function create($request, Store $store)
    {
        $category = Category::query()->create([
            'name' => $request->name,
            'store_id' => $store->id
        ]);
        $type = $this->createType($request,$category->id);
        return $category;
    }

    public  function update(Category $category, $request)
    {
        $category->update([
            'name' => $request->name
        ]);
        return $category;
    }

    public function deleteCategory(Category $category)
    {
        $category->delete();
    }
}
