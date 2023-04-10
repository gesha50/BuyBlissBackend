<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Http\Resources\Product\ProductCollection;
use App\Http\Resources\Product\ProductResource;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return ProductCollection
     */
    public function index(): ProductCollection
    {
        return new ProductCollection(Product::with('productCategories')->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreProductRequest $request
     * @return ProductResource
     */
    public function store(StoreProductRequest $request): ProductResource
    {
        $product = Product::create($request->all());
        return new ProductResource(Product::with('productCategories')->findOrFail($product->id));
    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @return ProductResource
     */
    public function show(Product $product): ProductResource
    {
        return new ProductResource(Product::with('productCategories')->findOrFail($product->id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProductRequest $request
     * @param Product $product
     * @return ProductResource
     */
    public function update(UpdateProductRequest $request, Product $product): ProductResource
    {
        $product->update([
            'title' => $request->title ?: $product->title,
            'description' => $request->description ?: $product->description,
            'full_title' => $request->full_title ?: $product->full_title,
            'full_description' => $request->full_description ?: $product->full_description,
            'meta_title' => $request->meta_title ?: $product->meta_title,
            'meta_description' => $request->meta_description ?: $product->meta_description,
            'is_active' => $request->is_active ?: $product->is_active,
            'is_error' => $request->is_error ?: $product->is_error,
        ]);
        return new ProductResource(Product::with('productCategories')->findOrFail($product->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return array
     */
    public function destroy(Product $product): array
    {
        $product->delete();
        return [
            'success'=> true,
            'message' => 'delete success'
        ];
    }
}
