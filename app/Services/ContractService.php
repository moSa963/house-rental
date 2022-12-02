<?php

namespace App\Services;

use App\Models\Contract;
use App\Models\User;
use Carbon\Carbon;

class ContractService 
{
    public static function calculate_total_price(string $start_date, string $end_date, $night_cost) : int
    {
        $start = new Carbon($start_date);
        $end = new Carbon($end_date);

        return $end->diffInDays($start) * $night_cost;
    }

    public static function list(User $user) {
        return Contract::select("contracts.*")
            ->join("houses", "houses.id", "=", "contracts.house_id")
            ->join("users as owners", "owners.id", "=", "houses.user_id")
            ->join("users", "users.id", "=", "contracts.user_id")
            ->where("users.id", $user->id)
            ->orWhere("owners.id", $user->id);
    }
}