<?php

namespace App\Services;

use App\Models\Contract;
use App\Models\House;
use Carbon\Carbon;
use Illuminate\Support\Facades\Date;

class HouseService 
{
    /**
     * Determine if the house is available to rent
     */
    public static function is_available(House $house, string $start, string $end) : bool 
    {
        $start_date = new Carbon($start);
        $end_date = new Carbon($end);

        $contract_exist = $house->confirmed_contracts()
                                ->whereDate("start_date", "<=", $start_date)
                                ->whereDate("end_date", ">=", $end_date)
                                ->exists();

        return ! $contract_exist;
    }


    public static function userCanAddReview($user, $house) : bool 
    {   
        return $house->confirmed_contracts()
                    ->where("user_id", $user->id)
                    ->whereDate("start_date", "<=", Date::today()->format('Y-m-d'))
                    ->exists();
    }
}