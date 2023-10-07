<?php

namespace App\Http\Controllers\Categorization;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Store;
use App\Models\Type;
use App\Repository\Categorization\Product\ProductRepositoryInterface;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    protected $productRepository;
    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function index( Request $request)
    {
        return $this->productRepository->getAllProducts(  $request);
    }

    public function store(Type $type, StoreProductRequest $request)
    {
        $product = $this->productRepository->create($type, $request);
        return successResponse($product);
    }

    public function show(Product $product)
    {
        return successResponse($this->productRepository->getProductById($product));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        return successResponse($this->productRepository->update($product, $request));
    }

    public function destroy(Product $product)
    {
        $this->productRepository->deleteProduct($product);
        return successMessage('deleted success');
    }

    public function addRating(Request $request, Product $product) {
//       must replace 1 (user_id) to the Auth::user() after add auth section
        $request->validate([
            'rate' => 'required|numeric|min:0|max:5'
        ]);
        $rate =  $product->addRating($request->rate, 2);
        return successResponse($rate);
    }

    public function getRatings(Product $product) {
        return successResponse($product->getRatingsInfo());
    }

    public function getTopRatedProducts() {
        $productsNumber = \request()->query('products');
        return successResponse($this->productRepository->getTopRatedProducts($productsNumber));
    }

    public function getMostPopularProducts() {
        $products = $this->productRepository->mostPopularProducts();
        return successResponse($products);
    }
}
