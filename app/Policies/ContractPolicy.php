<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Contract;
use App\Models\House;
use GuzzleHttp\Psr7\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class ContractPolicy
{
    use HandlesAuthorization;


    public function view(User $user, Contract $contract) : bool
    {
        return in_array($user->id, [$contract->user_id, $contract->house->user_id]);
    }

    public function create(User $user, House $house) : bool
    {
        return $house->active;
    }

    public function pay(User $user, Contract $contract)
    {
        return $user->user_id == $contract->user_id && $contract->house->active;
    }

    public function delete(User $user, Contract $contract)
    {
        return $contract->user_id == $user->id && $contract->confirmed == 0;
    }
}
