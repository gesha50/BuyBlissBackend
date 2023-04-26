<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Size\StoreSizeRequest;
use App\Http\Requests\Size\UpdateSizeRequest;
use App\Http\Resources\Size\SizeCollection;
use App\Http\Resources\Size\SizeResource;
use App\Models\PriceChangeSize;
use App\Models\Product;
use App\Models\Size;

class SizeController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param StoreSizeRequest $request
     * @return SizeResource
     */
    public function store(StoreSizeRequest $request): SizeResource
    {
        $size = Size::create($request->only(['title', 'length', 'width', 'height', 'product_id']));
        if ($request->exists('extra_price')){
            PriceChangeSize::create([
                'extra_price' => $request->extra_price,
                'size_id' => $size->id
            ]);
        }
        return new SizeResource(
            Size::with(['product', 'priceChangeSizes'])->findOrFail($size->id)
        );
    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @return SizeCollection
     */
    public function show(Product $product): SizeCollection
    {
        return new SizeCollection(
            Size::where('product_id', $product->id)
                ->with(['product', 'priceChangeSizes', 'priceChangeSizesLast'])
                ->orderBy('id', 'desc')
                ->get()
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateSizeRequest $request
     * @param Size $size
     * @return SizeResource
     */
    public function update(UpdateSizeRequest $request, Size $size): SizeResource
    {
        $size->update([
            'title' => $request->title ?: $size->title,
            'length' => $request->exists('length') ? $request->length : $size->length,
            'width' => $request->exists('width') ? $request->width : $size->width,
            'height' => $request->exists('height') ? $request->height : $size->height,
            'product_id' => $request->product_id ?: $size->product_id,
        ]);
        if ($request->exists('extra_price')){
            PriceChangeSize::create([
                'extra_price' => $request->extra_price,
                'size_id' => $size->id
            ]);
        }
        return new SizeResource(
            Size::where('id', $size->id)
                ->with(['product', 'priceChangeSizes'])
                ->first()
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Size $size
     * @return array
     */
    public function destroy(Size $size): array
    {
        $size->delete();
        return [
            'success'=> true,
            'message' => 'delete success'
        ];
    }
}
