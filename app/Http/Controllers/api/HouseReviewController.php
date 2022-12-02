<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreHouseReviewRequest;
use App\Http\Resources\HouseReviewResource;
use App\Models\Contract;
use App\Models\House;
use App\Models\HouseReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;

class HouseReviewController extends Controller
{
    public function create(Request $request, House $house){
        abort_if(! Auth::check(), 200);

        $review = $house->reviews()->where("user_id", $request->user()->id)->first();

        abort_if(! $review, 200);

        return new HouseReviewResource($review);
    }

    public function index(Request $request, House $house){
        $reviews = $house->reviews()->simplePaginate(10);
        
        return HouseReviewResource::collection($reviews);
    }

    public function store(StoreHouseReviewRequest $request, House $house){
        $this->authorize("create", [HouseReview::class, $house]);

        $review = $request->store_review($house);

        return new HouseReviewResource($review);
    }
}
