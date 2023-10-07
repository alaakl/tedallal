<?php

namespace App\Repository\Categorization\Product;

use App\Models\Product;
use Illuminate\Http\Request;

use App\Models\Type;

interface ProductRepositoryInterface {

    public function getAllProducts(Request $request);

    public function getProductById(Product $product);

    public function create(Type $type, $request);

    public function update(Product $product, $request);

    public function deleteProduct(Product $product);

    public function getTopRatedProducts($productsNumber);

    public function mostPopularProducts();
}
