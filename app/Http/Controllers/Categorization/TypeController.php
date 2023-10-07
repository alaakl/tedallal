<?php
namespace App\Http\Controllers\Categorization;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Type;
use App\Http\Requests\StoreTypeRequest;
use App\Http\Requests\UpdateTypeRequest;
use App\Repository\Categorization\Type\TypeRepositoryInterface;

class TypeController extends Controller
{
    protected $typeRepository;
    public function __construct(TypeRepositoryInterface $typeRepository)
    {
        $this->typeRepository = $typeRepository;
    }

    public function index()
    {
        return successResponse($this->typeRepository->getAllTypes());
    }

    public function store(StoreTypeRequest $request, Category $category)
    {
        $type = $this->typeRepository->create($category, $request);
        return successResponse($type);
    }

    public function show(Type $type)
    {
        return successResponse($this->typeRepository->getTypeById($type));
    }

    public function update(UpdateTypeRequest $request, Type $type)
    {
        return successResponse($this->typeRepository->update($type, $request));
    }

    public function destroy(Type $type)
    {
        $this->typeRepository->deleteType($type);
        return successMessage('deleted success');
    }
}
