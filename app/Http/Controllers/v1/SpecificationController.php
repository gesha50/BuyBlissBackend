<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Specification\StoreSpecificationRequest;
use App\Http\Requests\Specification\UpdateSpecificationRequest;
use App\Http\Resources\Specification\SpecificationCollection;
use App\Http\Resources\Specification\SpecificationResource;
use App\Models\Specification;
use Illuminate\Support\Facades\Storage;

class SpecificationController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return SpecificationCollection
     */
    public function index(): SpecificationCollection
    {
        return new SpecificationCollection(Specification::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreSpecificationRequest $request
     * @return SpecificationResource
     */
    public function store(StoreSpecificationRequest $request): SpecificationResource
    {
        $specification = Specification::create($request->all());
        return new SpecificationResource($specification);
    }

    /**
     * Display the specified resource.
     *
     * @param Specification $specification
     * @return SpecificationResource
     */
    public function show(Specification $specification): SpecificationResource
    {
        return new SpecificationResource($specification);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateSpecificationRequest $request
     * @param Specification $specification
     * @return SpecificationResource
     */
    public function update(UpdateSpecificationRequest $request, Specification $specification): SpecificationResource
    {
        $specification->update([
            'title' => $request->title ?: $specification->title,
            'specification_category_id' =>
                $request->specification_category_id
                ?: $specification->specification_category_id,
            'type' => $request->type ?: $specification->type,
            'is_filter' => $request->is_filter ?: $specification->is_filter,
        ]);
        return new SpecificationResource($specification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Specification $specification
     * @return array
     */
    public function destroy(Specification $specification): array
    {
        $specification->delete();
        return [
            'success'=> true,
            'message' => 'delete success'
        ];
    }
}
