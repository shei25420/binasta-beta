<?php

namespace App\Http\Controllers;

use App\Models\DistributorReview;
use App\Http\Requests\StoreDistributorReviewRequest;
use App\Http\Requests\UpdateDistributorReviewRequest;
use Illuminate\Support\Facades\Validator;

class DistributorReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDistributorReviewRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDistributorReviewRequest $request)
    {
        $data = $request->validated();
        $data['distributor_id'] = auth('distributor')->id();
        DistributorReview::create($data);

        return response()->redirectTo('/distributor_packages/'.$data['distributor_package_id']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DistributorReview  $distributorReview
     * @return \Illuminate\Http\Response
     */
    public function show(DistributorReview $distributorReview)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDistributorReviewRequest  $request
     * @param  \App\Models\DistributorReview  $distributorReview
     * @return \Illuminate\Http\Response
     */
    public function update($subdomain, UpdateDistributorReviewRequest $request, $id)
    {
        $data = $request->validated();
        $data['id'] = Validator::make(['id' => $id], ['id' => 'required|numeric|exists:distributor_reviews,id'])->validated()['id'];

        $review = DistributorReview::where('id', $data['id'])->where('distributor_id', auth('distributor')->id())->firstOrFail();
        
        $slug = $review->slug;
        $review->update($data);

        return response()->redirectTo('/distributor_packages/'.$slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DistributorReview  $distributorReview
     * @return \Illuminate\Http\Response
     */
    public function destroy($subdomain, $id)
    {
        $id = Validator::make(['id' => $id], ['id' => 'required|numeric|exists:distributor_reviews,id'])->validated()['id'];

        $review = DistributorReview::find($id);
        
        $slug = $review->slug;
        $review->delete();

        return response()->redirectTo('/distributor_packages/'.$slug);
    }

    public function banReview ($id) {
        $id = Validator::make(['id' => $id], ['id' => 'required|numeric|exists:distributor_reviews,id'])->validated()['id'];


    }
}
