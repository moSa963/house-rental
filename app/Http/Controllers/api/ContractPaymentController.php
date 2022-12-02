<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreContractPaymentRequest;
use App\Models\Contract;
use App\Models\House;
use App\Services\ContractService;
use App\Services\HouseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContractPaymentController extends Controller
{
    public function store(StoreContractPaymentRequest $request, House $house, Contract $contract){
        $this->authorize("pay", $contract);

        if (! HouseService::is_available($house, $contract->start_date, $contract->end_date))
        {
            abort(400, "The requested time is not available, try to change the reservation time.");
        }

        DB::transaction(function() use($contract, ){
            $contract->update(["confirmed" => true]);

            //TODO: payment....
            $payment_confirmed = true;
        });

        $request->store_payment($contract, $contract->total_price);

        return response()->noContent();
    }
}
