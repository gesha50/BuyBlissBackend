<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductCategory\StoreProductCategoryRequest;
use App\Http\Requests\ProductCategory\UpdateProductCategoryRequest;
use App\Http\Resources\ProductCategory\ProductCategoryCollection;
use App\Http\Resources\ProductCategory\ProductCategoryResource;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Storage;

class ProductCategoryController extends Controller
{

    private $storageFolderName = 'ProductCategories';
    /**
     * Display a listing of the resource.
     *
     * @return ProductCategoryCollection
     */
    public function index(): ProductCategoryCollection
    {
        return new ProductCategoryCollection(ProductCategory::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreProductCategoryRequest $request
     * @return ProductCategoryResource
     */
    public function store(StoreProductCategoryRequest $request): ProductCategoryResource
    {
        $productCat = ProductCategory::create($request->all());
        if ($request->hasFile('img')){
            $productCat->img  = $request->file('img')->store($this->storageFolderName, 'public');
            $productCat->save();
        }
        return new ProductCategoryResource(
            ProductCategory::with('products')->find($productCat->id)
        );
    }

    /**
     * Display the specified resource.
     *
     * @param ProductCategory $productCategory
     * @return ProductCategoryResource
     */
    public function show(ProductCategory $productCategory): ProductCategoryResource
    {
        return new ProductCategoryResource(
            ProductCategory::with('products')->findOrFail($productCategory->id)
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProductCategoryRequest $request
     * @param ProductCategory $productCategory
     * @return ProductCategoryResource
     */
    public function update(
        UpdateProductCategoryRequest $request,
        ProductCategory $productCategory
    ): ProductCategoryResource
    {
        $productCategory->update([
            'title' => $request->title ?: $productCategory->title,
            'slug' => $request->slug ?: $productCategory->slug,
            'level' => $request->level ?: $productCategory->level,
            'product_category_id' => $request->product_category_id ?: $productCategory->product_category_id,
        ]);
        if ($request->hasFile('img')){
            Storage::disk('public')->delete($productCategory->img);
            $productCategory->img = $request->file('img')->store($this->storageFolderName, 'public');
            $productCategory->save();
        }
        return new ProductCategoryResource(
            ProductCategory::with('products')->findOrFail($productCategory->id)
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ProductCategory $productCategory
     * @return array
     */
    public function destroy(ProductCategory $productCategory): array
    {
        if (isset($productCategory->img)) {
            Storage::disk('public')->delete($productCategory->img);
        }
        $productCategory->delete();
        return [
            'success'=> true,
            'message' => 'delete success'
        ];
    }
}
