<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\PriceChanges\StorePriceChangesRequest;
use App\Http\Requests\PriceChanges\UpdatePriceChangesRequest;
use App\Http\Resources\PriceChanges\PriceChangesResource;
use App\Models\PriceChanges;
use App\Models\Product;

class PriceChangesController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePriceChangesRequest $request
     * @return PriceChangesResource
     */
    public function store(StorePriceChangesRequest $request): PriceChangesResource
    {
        $priceChange = PriceChanges::create($request->all());
        return new PriceChangesResource(
            PriceChanges::with('product')->findOrFail($priceChange->id)
        );
    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @return PriceChangesResource
     */
    public function showFull(Product $product): PriceChangesResource
    {
        return new PriceChangesResource(
            PriceChanges::where('product_id', $product->id)
                ->orderBy('id', 'desc')
                ->with('product')
                ->get()
        );
    }

    /**
     * Display the specified resource.
     *
     * @param PriceChanges $priceChange
     * @return PriceChangesResource
     */
    public function show(Product $product): PriceChangesResource
    {
        return new PriceChangesResource(
            PriceChanges::where('product_id', $product->id)
                ->orderBy('id', 'desc')
                ->with('product')
                ->first()
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePriceChangesRequest $request
     * @param PriceChanges $priceChange
     * @return PriceChangesResource
     */
    public function update(UpdatePriceChangesRequest $request, PriceChanges $priceChange): PriceChangesResource
    {
        $priceChange->update([
            'new_price' => $request->new_price ?: $priceChange->new_price,
            'price_with_discount' => $request->price_with_discount ?: $priceChange->price_with_discount,
            'discount_finish_at' => $request->discount_finish_at ?: $priceChange->discount_finish_at,
            'product_id' => $request->product_id ?: $priceChange->product_id,
        ]);
        return new PriceChangesResource(
            PriceChanges::with('product')->findOrFail($priceChange->id)
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param PriceChanges $priceChange
     * @return array
     */
    public function destroy(PriceChanges $priceChange): array
    {
        $priceChange->delete();
        return [
            'success'=> true,
            'message' => 'delete success'
        ];
    }
}
