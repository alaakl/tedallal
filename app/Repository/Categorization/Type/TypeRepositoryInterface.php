<?php

namespace App\Repository\Categorization\Type;

use App\Models\Category;
use App\Models\Type;

interface TypeRepositoryInterface {

    public function getAllTypes();

    public function getTypeById(Type $type);

    public function create(Category $category, $request);
    public function update(Type $type, $request);

    public function deleteType(Type $type);
}
