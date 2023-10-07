<?php

namespace App\Repository\Categorization\Type;

use App\Models\Category;
use App\Models\Type;

class TypeRepository implements TypeRepositoryInterface
{
    public function getAllTypes() {
        $types = Type::query()->get();
        return $types;
    }

    public function getTypeById(Type $type) {
        return $type->products()->paginate(100);
    }

    public function create(Category $category, $request) {
        $type = Type::query()->create([
            'name' => $request->name,
            'category_id' => $category->id
        ]);
        return $type;
    }

    public function update(Type $type, $request)
    {
        $type->update([
           'name' => $request->name
        ]);
        return $type;
    }

    public function deleteType(Type $type) {
        $type->delete();
    }

}
