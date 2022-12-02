<?php

namespace Tests\Unit;

use App\Services\ContractService;
use Carbon\Carbon;
use PHPUnit\Framework\TestCase;

class ContractServiceTest extends TestCase
{

    public function test_calculate_contracts_total_price()
    {
        $start_date = Carbon::today();
        $end_date = Carbon::today()->addDays(7);
        $night_cost = 100;

        $total = ContractService::calculate_total_price($start_date, $end_date, $night_cost);

        $this->assertTrue($total == 700);
    }
}
