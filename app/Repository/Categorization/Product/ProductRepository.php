<?php

namespace App\Repository\Categorization\Product;


use App\Models\PaidProduct;
use App\Models\Product;
use App\Models\Type;
use App\Traits\GeneralTrait;
use App\Traits\RatingTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ProductRepository implements ProductRepositoryInterface
{
    use GeneralTrait, RatingTrait;

    public function getAllProducts(Request $request) {

        $products_by_name = Product::query();
        $searchByName = $request->searchByName;
        if ($searchByName !== null) {
            $products_by_name->where('name', 'LIKE', '%'. $searchByName . '%');
        }
        $products = $products_by_name->get();

        return $products;
    }

    public function getProductById(Product $product) {
        return $product;
    }

    public function create(Type $type, $request) {
        $imageUrl = null;
        if ($request->hasFile('image')) {
            $imageUrl = uploadFile('images/products', $request->image);
        }
        $product = Product::query()->create([
            'name' => $request->name,
            'image' => $imageUrl,
            'price' => $request->price,
            'description' => $request->description,
            'type_id' => $type->id,
            'quantity' => $request->quantity,
        ]);
        return $product;
    }

    public function update(Product $product, $request)
    {
        $data = [
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
        ];
        if ($request->hasFile('image')) {
            $data['image'] = replaceFile($product->image, 'images/products', $request->image);
        }
        $product->update($data);
        return $product;
    }

    public function deleteProduct(Product $product) {
        deleteFile($product->image);
        $product->delete();
    }

    public function getTopRatedProducts($productsNumber)
    {
        $products =  Product::query()->get();
        $data = array_values($products->sortByDesc('rating')->take($productsNumber)->toArray());
        return $data;
    }

    public function mostPopularProducts()
    {
        $paidProducts = DB::select(
            "SELECT name, sum(quantity)
                    FROM paid_products
                    group by name
                    order by sum(quantity) desc
                    Limit 0, 10
            ");
        foreach ($paidProducts as $paidProduct) {
            $names[] = $paidProduct->name;
        }
        $products = Product::query()->whereIn('name', $names)->where('quantity', '>', 0)->get();
        return $products;
    }

}
