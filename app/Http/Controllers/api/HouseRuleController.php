<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SotreHouseRuleRequest;
use App\Http\Resources\HouseRuleResource;
use App\Models\House;
use App\Models\HouseRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HouseRuleController extends Controller
{
    public function store(SotreHouseRuleRequest $request, House $house){
        $this->authorize("update", $house);

        $rules = $request->add_rules($house);

        return HouseRuleResource::collection($rules);
    }

    public function destroy(Request $request, House $house, HouseRule $rule){
        $this->authorize("update", $house);

        $rule->delete();

        return response()->noContent();
    }
}
