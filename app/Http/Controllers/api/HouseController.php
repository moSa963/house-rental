<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreHouseRequest;
use App\Http\Requests\UpdateHouseRequest;
use App\Http\Resources\HouseCollection;
use App\Http\Resources\HouseResource;
use App\Models\House;
use App\Services\HouseListService;
use App\Services\HouseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HouseController extends Controller
{
    public function create(Request $request, House $house){
        $this->authorize("view", $house);

        return new HouseResource($house);
    }

    public function index(Request $request){
        $houses = (new HouseListService())
            ->filterCity($request->query("city"))
            ->filterCountry($request->query("country"))
            ->filterUsername($request->query("username"))
            ->get();

        return HouseCollection::collection($houses);
    }

    public function store(StoreHouseRequest $request){
        $house = $request->store_house($request->user());

        return new HouseResource($house);
    }

    public function update(UpdateHouseRequest $request, House $house){
        $this->authorize("update", $house);

        $house = $request->update_house($house);

        return new HouseResource($house);
    }

    //check if this house is available during start and end date
    public function check(Request $request, House $house, $start_date, $end_date){
        Validator::make([
            'start_date' => $start_date,
            'end_date' => $end_date,
        ], [
            'start_date' => ["required", "date", "date_format:Y-m-d", "after:today", "before:end_date"],
            'end_date' => ["required", "date", "date_format:Y-m-d", "after:start_date"],
        ])->validate();

        return response()->json([
            "available" => $house->active && HouseService::is_available($house, $start_date, $end_date),
        ], 200);
    }
}
