<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\SpecificationValue\StoreSpecificationValueRequest;
use App\Http\Requests\SpecificationValue\UpdateSpecificationValueRequest;
use App\Http\Resources\SpecificationValue\SpecificationValueCollection;
use App\Http\Resources\SpecificationValue\SpecificationValueResource;
use App\Models\SpecificationValue;
use Illuminate\Support\Facades\Storage;

class SpecificationValueController extends Controller
{
    private $storageFolderName = 'Specifications';
    /**
     * Display a listing of the resource.
     *
     * @return SpecificationValueCollection
     */
    public function index(): SpecificationValueCollection
    {
        return new SpecificationValueCollection(SpecificationValue::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreSpecificationValueRequest $request
     * @return SpecificationValueResource
     */
    public function store(StoreSpecificationValueRequest $request): SpecificationValueResource
    {
        $specificationValue = SpecificationValue::create($request->all());
        if ($request->hasFile('img')){
            $specificationValue->img  = $request->file('img')->store($this->storageFolderName, 'public');
            $specificationValue->save();
        }
        return new SpecificationValueResource($specificationValue);
    }

    /**
     * Display the specified resource.
     *
     * @param SpecificationValue $specificationValue
     * @return SpecificationValueResource
     */
    public function show(SpecificationValue $specificationValue): SpecificationValueResource
    {
        return new SpecificationValueResource($specificationValue);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateSpecificationValueRequest $request
     * @param SpecificationValue $specificationValue
     * @return SpecificationValueResource
     */
    public function update(
        UpdateSpecificationValueRequest $request,
        SpecificationValue $specificationValue
    ): SpecificationValueResource
    {
        $specificationValue->update([
            'value' => $request->value ?: $specificationValue->value,
            'description' => $request->description ?: $specificationValue->description,
            'specification_id' => $request->specification_id ?: $specificationValue->specification_id,
        ]);
        if ($request->hasFile('img')){
            Storage::disk('public')->delete($specificationValue->img);
            $specificationValue->img = $request->file('img')->store($this->storageFolderName, 'public');
            $specificationValue->save();
        }
        return new SpecificationValueResource($specificationValue);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param SpecificationValue $specificationValue
     * @return array
     */
    public function destroy(SpecificationValue $specificationValue): array
    {
        $specificationValue->delete();
        return [
            'success'=> true,
            'message' => 'delete success'
        ];
    }
}
