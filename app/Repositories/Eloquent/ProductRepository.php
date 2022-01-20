<?php

namespace App\Repositories\Eloquent;


use App\Models\Product;
use App\Interfaces\ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface
{

    public function index(array $data)
    {
        $products = Product::with('provider')->latest();

        return $products->paginate($data['per_page'] ?? 10, '*', 'page', $data['page'] ?? 1);
    }

    public function show(int $id)
    {
        return Product::findOrFail($id);
    }

    public function store(array $data)
    {
        return Product::create($data);
    }

    public function update($product, array $data)
    {
        $product->fill($data);

        $product->save();
    }

    public function destroy($product)
    {
        $product->delete();
    }
}