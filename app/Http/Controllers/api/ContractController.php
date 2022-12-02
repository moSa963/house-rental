<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreContractRequest;
use App\Http\Resources\ContractResource;
use App\Models\Contract;
use App\Models\House;
use App\Services\ContractService;
use App\Services\HouseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContractController extends Controller
{
    public function index(Request $request){
        $contracts = ContractService::list($request->user())
                            ->simplePaginate(10)
                            ->withQueryString();

        return ContractResource::collection($contracts);
    }
    
    public function create(Request $request, Contract $contract){
        $this->authorize("view", $contract);
        
        $contract["username"] = $contract->user->username;

        return new ContractResource($contract);
    }

    public function store(StoreContractRequest $request, House $house){
        $this->authorize("create", [Contract::class, $house]);

        if (! HouseService::is_available($house, $request->start_date, $request->end_date)){
            abort(400, "The requested time is not available, try to change the reservation time.");
        }

        $total_price = ContractService::calculate_total_price($request->start_date, $request->end_date, $house->night_cost);

        $contract = $request->store_contract($house, $total_price);

        return new ContractResource($contract);
    }

    public function destroy(Request $request, Contract $contract){
        $this->authorize("delete", $contract);

        $contract->delete();

        return response()->noContent();
    }
}