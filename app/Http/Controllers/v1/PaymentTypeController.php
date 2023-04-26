<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentType\StorePaymentTypeRequest;
use App\Http\Requests\PaymentType\UpdatePaymentTypeRequest;
use App\Http\Resources\PaymentType\PaymentTypeCollection;
use App\Http\Resources\PaymentType\PaymentTypeResource;
use App\Models\PaymentType;

class PaymentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return PaymentTypeCollection
     */
    public function index(): PaymentTypeCollection
    {
        return new PaymentTypeCollection(PaymentType::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePaymentTypeRequest $request
     * @return PaymentTypeResource
     */
    public function store(StorePaymentTypeRequest $request): PaymentTypeResource
    {
        $paymentType = PaymentType::create($request->all());
        return new PaymentTypeResource($paymentType);
    }

    /**
     * Display the specified resource.
     *
     * @param PaymentType $paymentType
     * @return PaymentTypeResource
     */
    public function show(PaymentType $paymentType): PaymentTypeResource
    {
        return new PaymentTypeResource($paymentType);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePaymentTypeRequest $request
     * @param PaymentType $paymentType
     * @return PaymentTypeResource
     */
    public function update(UpdatePaymentTypeRequest $request, PaymentType $paymentType): PaymentTypeResource
    {
        $paymentType->update([
            'title' => $request->title ?: $paymentType->title,
            'is_main' => $request->exists('is_main') ? $request->is_main : $paymentType->is_main,
        ]);
        return new PaymentTypeResource($paymentType);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param PaymentType $paymentType
     * @return array
     */
    public function destroy(PaymentType $paymentType): array
    {
        $paymentType->delete();
        return [
            'success'=> true,
            'message' => 'delete success'
        ];
    }
}
