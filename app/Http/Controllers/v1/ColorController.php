<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Colors\AddColorToProductRequest;
use App\Http\Requests\Colors\StoreColorRequest;
use App\Http\Requests\Colors\UpdateColorRequest;
use App\Http\Resources\Colors\ColorCollection;
use App\Http\Resources\Colors\ColorResource;
use App\Http\Resources\Product\ProductResource;
use App\Models\Color;
use App\Models\ColorCategory;
use App\Models\PriceChangeColor;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ColorController extends Controller
{
    private $storageFolderName = 'Colors';

    /**
     * Display a listing of the resource.
     *
     * @return ColorCollection
     */
    public function index(): ColorCollection
    {
        return new ColorCollection(Color::with('colorCategory')->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreColorRequest $request
     * @return ColorResource
     */
    public function store(StoreColorRequest $request): ColorResource
    {
        $color = Color::create($request->only(['title', 'color_code', 'color_category_id']));
        $colorCat = ColorCategory::find($request->color_category_id);
        $colorCat->colors()->save($color);
        if ($request->hasFile('img')){
            $color->img  = $request->file('img')->store($this->storageFolderName, 'public');
            $color->save();
        }
        if ($request->exists('extra_price')){
            PriceChangeColor::create([
                'extra_price' => $request->extra_price,
                'color_id' => $color->id
            ]);
        }
        return new ColorResource(
            Color::with(['colorCategory', 'priceChangeColors', 'priceChangeColorsLast'])
                ->find($color->id)
        );
    }

    public function addColorToProduct(AddColorToProductRequest $request, Product $product): ProductResource
    {
        foreach ($request->arr_color_ids as $id) {
            $product->colors()->attach($id);
        }
        return new ProductResource(
            Product::with(['productCategories', 'priceChanges', 'sizes', 'colors'])
            ->find($product->id)
        );
    }

    /**
     * Display the specified resource.
     *
     * @param Color $color
     * @return ColorResource
     */
    public function show(Color $color): ColorResource
    {
        return new ColorResource(Color::with('colorCategory')->findOrFail($color->id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateColorRequest $request
     * @param Color $color
     * @return ColorResource
     */
    public function update(UpdateColorRequest $request, Color $color): ColorResource
    {
        $color->update([
            'title' => $request->title ?: $color->title,
            'color_code' => $request->color_code ?: $color->color_code,
        ]);
        $colorCat = ColorCategory::find($request->color_category_id);
        $colorCat->colors()->save($color);
        if ($request->hasFile('img')){
            Storage::disk('public')->delete($color->img);
            $color->img = $request->file('img')->store($this->storageFolderName, 'public');
            $color->save();
        }
        if ($request->exists('extra_price')){
            PriceChangeColor::create([
                'extra_price' => $request->extra_price,
                'color_id' => $color->id
            ]);
        }
        return new ColorResource(
            Color::with(['colorCategory', 'priceChangeColors', 'priceChangeColorsLast'])
                ->find($color->id)
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Color $color
     * @return array
     */
    public function destroy(Color $color): array
    {
        if (isset($color->img)) {
            Storage::disk('public')->delete($color->img);
        }
        $color->delete();
        return [
            'success'=> true,
            'message' => 'delete success'
        ];
    }
}
