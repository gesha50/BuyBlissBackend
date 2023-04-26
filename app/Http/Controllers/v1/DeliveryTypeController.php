<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\DeliveryType\StoreDeliveryTypeRequest;
use App\Http\Requests\DeliveryType\UpdateDeliveryTypeRequest;
use App\Http\Resources\DeliveryType\DeliveryTypeCollection;
use App\Http\Resources\DeliveryType\DeliveryTypeResource;
use App\Models\DeliveryType;

class DeliveryTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return DeliveryTypeCollection
     */
    public function index(): DeliveryTypeCollection
    {
        return new DeliveryTypeCollection(DeliveryType::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreDeliveryTypeRequest $request
     * @return DeliveryTypeResource
     */
    public function store(StoreDeliveryTypeRequest $request): DeliveryTypeResource
    {
        $deliveryType = DeliveryType::create($request->all());
        return new DeliveryTypeResource($deliveryType);
    }

    /**
     * Display the specified resource.
     *
     * @param DeliveryType $deliveryType
     * @return DeliveryTypeResource
     */
    public function show(DeliveryType $deliveryType): DeliveryTypeResource
    {
        return new DeliveryTypeResource($deliveryType);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateDeliveryTypeRequest $request
     * @param DeliveryType $deliveryType
     * @return DeliveryTypeResource
     */
    public function update(UpdateDeliveryTypeRequest $request, DeliveryType $deliveryType): DeliveryTypeResource
    {
        $deliveryType->update([
            'title' => $request->title ?: $deliveryType->title,
            'is_main' => $request->is_main ?: $deliveryType->is_main,
        ]);
        return new DeliveryTypeResource($deliveryType);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DeliveryType $deliveryType
     * @return array
     */
    public function destroy(DeliveryType $deliveryType): array
    {
        $deliveryType->delete();
        return [
            'success'=> true,
            'message' => 'delete success'
        ];
    }
}
