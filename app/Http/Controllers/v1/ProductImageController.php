<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductImage\StoreProductImageRequest;
use App\Http\Requests\ProductImage\UpdateProductImageRequest;
use App\Http\Resources\ProductImage\ProductImageCollection;
use App\Http\Resources\ProductImage\ProductImageResource;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Storage;

class ProductImageController extends Controller
{
    private $storageFolderName = 'ProductImages';

    /**
     * Display a listing of the resource.
     *
     * @return ProductImageCollection
     */
    public function index(): ProductImageCollection
    {
        return new ProductImageCollection(ProductImage::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreProductImageRequest $request
     * @return ProductImageResource
     */
    public function store(StoreProductImageRequest $request): ProductImageResource
    {
        $productImage = ProductImage::create($request->all());
        if ($request->hasFile('img')){
            $productImage->img  = $request->file('img')->store($this->storageFolderName, 'public');
            $productImage->save();
        }
        return new ProductImageResource($productImage);
    }

    /**
     * Display the specified resource.
     *
     * @param ProductImage $productImage
     * @return ProductImageResource
     */
    public function show(ProductImage $productImage): ProductImageResource
    {
        return new ProductImageResource($productImage);
    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @return ProductImageCollection
     */
    public function showProductImages(Product $product): ProductImageCollection
    {
        return new ProductImageCollection(ProductImage::where('product_id', $product->id)->get());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProductImageRequest $request
     * @param ProductImage $productImage
     * @return ProductImageResource
     */
    public function update(UpdateProductImageRequest $request, ProductImage $productImage): ProductImageResource
    {
        $productImage->update([
            'title' => $request->title ?: $productImage->title,
            'is_poster' => $request->is_poster ?: $productImage->is_poster,
            'is_universal' => $request->is_universal ?: $productImage->is_universal,
            'product_id' => $request->product_id ?: $productImage->product_id,
            'color_product_id' => $request->color_product_id ?: $productImage->color_product_id,
        ]);
        if ($request->hasFile('img')){
            Storage::disk('public')->delete($productImage->img);
            $productImage->img = $request->file('img')->store($this->storageFolderName, 'public');
            $productImage->save();
        }
        return new ProductImageResource($productImage);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ProductImage $productImage
     * @return array
     */
    public function destroy(ProductImage $productImage): array
    {
        if (isset($productImage->img)) {
            Storage::disk('public')->delete($productImage->img);
        }
        $productImage->delete();
        return [
            'success'=> true,
            'message' => 'delete success'
        ];
    }
}
