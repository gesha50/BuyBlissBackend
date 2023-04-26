<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\StoreOrderRequest;
use App\Http\Requests\Order\UpdateOrderRequest;
use App\Http\Resources\Order\OrderCollection;
use App\Http\Resources\Order\OrderResource;
use App\Models\Order;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return OrderCollection
     */
    public function index(): OrderCollection
    {
        return new OrderCollection(
            Order::with(['user', 'address', 'status', 'paymentType', 'deliveryType'])
                ->get()
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreOrderRequest $request
     * @return OrderResource
     */
    public function store(StoreOrderRequest $request): OrderResource
    {
        $order = Order::create($request->except('arr_product_ids'));
        foreach ($request->arr_product_ids as $id) {
            $order->products()->attach($id);
        }
        return new OrderResource($order);
    }

    /**
     * Display the specified resource.
     *
     * @param Order $order
     * @return OrderResource
     */
    public function show(Order $order): OrderResource
    {
        return new OrderResource($order);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateOrderRequest $request
     * @param Order $order
     * @return OrderResource
     */
    public function update(UpdateOrderRequest $request, Order $order): OrderResource
    {
        $order->update([
           'name' => $request->name ?: $order->name,
           'phone' => $request->phone ?: $order->phone,
           'email' => $request->email ?: $order->email,
           'user_id' => $request->user_id ?: $order->user_id,
           'address_id' => $request->address_id ?: $order->address_id,
           'delivery_type_id' => $request->delivery_type_id ?: $order->delivery_type_id,
           'payment_type_id' => $request->payment_type_id ?: $order->payment_type_id,
           'status_id' => $request->status_id ?: $order->status_id,
        ]);
        return new OrderResource($order);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Order $order
     * @return array
     */
    public function destroy(Order $order): array
    {
        $order->delete();
        return [
            'success'=> true,
            'message' => 'delete success'
        ];
    }
}
