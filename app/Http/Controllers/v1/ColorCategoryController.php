<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ColorCategory\StoreColorCategoryRequest;
use App\Http\Requests\ColorCategory\UpdateColorCategoryRequest;
use App\Http\Resources\ColorCategory\ColorCategoryCollection;
use App\Http\Resources\ColorCategory\ColorCategoryResource;
use App\Models\ColorCategory;

class ColorCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return ColorCategoryCollection
     */
    public function index(): ColorCategoryCollection
    {
        return new ColorCategoryCollection(ColorCategory::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreColorCategoryRequest $request
     * @return ColorCategoryResource
     */
    public function store(StoreColorCategoryRequest $request): ColorCategoryResource
    {
        $colorCategory = ColorCategory::create($request->all());
        return new ColorCategoryResource(ColorCategory::find($colorCategory->id));
    }

    /**
     * Display the specified resource.
     *
     * @param ColorCategory $colorCategory
     * @return ColorCategoryResource
     */
    public function show(ColorCategory $colorCategory): ColorCategoryResource
    {
        return new ColorCategoryResource(ColorCategory::findOrFail($colorCategory->id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateColorCategoryRequest $request
     * @param ColorCategory $colorCategory
     * @return ColorCategoryResource
     */
    public function update(UpdateColorCategoryRequest $request, ColorCategory $colorCategory): ColorCategoryResource
    {
        $colorCategory->update([
            'title' => $request->title ?: $colorCategory->title,
            'is_img' => $request->is_img ?: $colorCategory->is_img,
        ]);
        return new ColorCategoryResource(ColorCategory::find($colorCategory->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ColorCategory $colorCategory
     * @return array
     */
    public function destroy(ColorCategory $colorCategory): array
    {
        $colorCategory->delete();
        return [
            'success'=> true,
            'message' => 'delete success'
        ];
    }
}
