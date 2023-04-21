<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\SpecificationCategory\StoreSpecificationCategoryRequest;
use App\Http\Requests\SpecificationCategory\UpdateSpecificationCategoryRequest;
use App\Http\Resources\SpecificationCategory\SpecificationCategoryCollection;
use App\Http\Resources\SpecificationCategory\SpecificationCategoryResource;
use App\Models\SpecificationCategory;

class SpecificationCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return SpecificationCategoryCollection
     */
    public function index(): SpecificationCategoryCollection
    {
        return new SpecificationCategoryCollection(SpecificationCategory::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreSpecificationCategoryRequest $request
     * @return SpecificationCategoryResource
     */
    public function store(StoreSpecificationCategoryRequest $request): SpecificationCategoryResource
    {
        $specificationCategory = SpecificationCategory::create($request->all());
        return new SpecificationCategoryResource($specificationCategory);
    }

    /**
     * Display the specified resource.
     *
     * @param SpecificationCategory $specificationCategory
     * @return SpecificationCategoryResource
     */
    public function show(SpecificationCategory $specificationCategory): SpecificationCategoryResource
    {
        return new SpecificationCategoryResource($specificationCategory);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateSpecificationCategoryRequest $request
     * @param SpecificationCategory $specificationCategory
     * @return SpecificationCategoryResource
     */
    public function update(
        UpdateSpecificationCategoryRequest $request,
        SpecificationCategory $specificationCategory
    ): SpecificationCategoryResource
    {
        $specificationCategory->update([
            'title' => $request->title ?: $specificationCategory->title,
            'is_img' => $request->is_img ?: $specificationCategory->is_img,
        ]);
        return new SpecificationCategoryResource($specificationCategory);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param SpecificationCategory $specificationCategory
     * @return array
     */
    public function destroy(SpecificationCategory $specificationCategory): array
    {
        $specificationCategory->delete();
        return [
            'success'=> true,
            'message' => 'delete success'
        ];
    }
}
