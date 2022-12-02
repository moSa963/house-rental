<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SotreHouseFeatureRequest;
use App\Http\Resources\HouseFeatureResource;
use App\Models\House;
use App\Models\HouseFeature;
use Illuminate\Http\Request;

class HouseFeatureController extends Controller
{
    public function store(SotreHouseFeatureRequest $request, House $house){
        $this->authorize("update", $house);

        $features = $request->add_feautures($house);

        return HouseFeatureResource::collection($features);
    }

    public function destroy(Request $request, House $house, HouseFeature $feature){
        $this->authorize("update", $house);

        $feature->delete();

        return response()->noContent();
    }
}
