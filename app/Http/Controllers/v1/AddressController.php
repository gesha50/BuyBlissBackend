<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Address\StoreAddressRequest;
use App\Http\Requests\Address\UpdateAddressRequest;
use App\Http\Resources\Address\AddressCollection;
use App\Http\Resources\Address\AddressResource;
use App\Models\Address;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AddressCollection
     */
    public function index(): AddressCollection
    {
        return new AddressCollection(Address::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreAddressRequest $request
     * @return AddressCollection
     */
    public function store(StoreAddressRequest $request): AddressCollection
    {
        Address::create($request->all());
        return new AddressCollection(Address::where('user_id', Auth::user()->id)->get());
    }

    /**
     * Display the specified resource.
     *
     * @param Address $address
     * @return AddressResource
     */
    public function show(Address $address): AddressResource
    {
        return new AddressResource($address);
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return AddressCollection
     */
    public function showUser(User $user): AddressCollection
    {
        return new AddressCollection(Address::where('user_id', $user->id)->get());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Address\UpdateAddressRequest  $request
     * @param Address $address
     * @return AddressCollection
     */
    public function update(UpdateAddressRequest $request, Address $address): AddressCollection
    {
        $address->update([
            'index' => $request->index ?: $address->index,
            'region' => $request->region ?: $address->region,
            'city' => $request->city ?: $address->city,
            'street' => $request->street ?: $address->street,
            'house' => $request->house ?: $address->house,
            'floor' => $request->exists('floor') ? $request->floor : $address->floor,
            'entrance' => $request->entrance ?: $address->entrance,
            'flat' => $request->flat ?: $address->flat,
            'is_private_house' => $request->exists('is_private_house')
                ? $request->is_private_house
                : $address->is_private_house,
            'is_main' => $request->exists('is_main') ? $request->is_main : $address->is_main,
            'user_id' => $request->user_id ?: $address->user_id,
        ]);
        return new AddressCollection(Address::where('user_id', Auth::user()->id)->get());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Address $address
     * @return array
     */
    public function destroy(Address $address): array
    {
        $address->delete();
        return [
            'success'=> true,
            'message' => 'delete success'
        ];
    }
}
