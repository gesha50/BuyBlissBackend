<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Feedback\StoreFeedbackRequest;
use App\Http\Requests\Feedback\UpdateFeedbackRequest;
use App\Http\Resources\Feedback\FeedbackCollection;
use App\Http\Resources\Feedback\FeedbackResource;
use App\Models\Feedback;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return FeedbackCollection
     */
    public function index(): FeedbackCollection
    {
        return new FeedbackCollection(Feedback::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreFeedbackRequest $request
     * @return FeedbackResource
     */
    public function store(StoreFeedbackRequest $request): FeedbackResource
    {
        $feedback = Feedback::create($request->all());
        return new FeedbackResource($feedback);
    }

    /**
     * Display the specified resource.
     *
     * @param Feedback $feedback
     * @return FeedbackResource
     */
    public function show(Feedback $feedback): FeedbackResource
    {
        return new FeedbackResource($feedback);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateFeedbackRequest $request
     * @param Feedback $feedback
     * @return FeedbackResource
     */
    public function update(UpdateFeedbackRequest $request, Feedback $feedback): FeedbackResource
    {
        $feedback->update([
            'name' => $request->name ?: $feedback->name,
            'description' => $request->description ?: $feedback->description,
            'stars' => $request->exists('stars')
                ? $request->stars
                : $feedback->stars,
            'user_id' => $request->user_id ?: $feedback->user_id,
            'order_id' => $request->order_id ?: $feedback->order_id,
            'product_id' => $request->product_id ?: $feedback->product_id,
        ]);
        return new FeedbackResource($feedback);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Feedback $feedback
     * @return array
     */
    public function destroy(Feedback $feedback): array
    {
        $feedback->delete();
        return [
            'success'=> true,
            'message' => 'delete success'
        ];
    }
}
