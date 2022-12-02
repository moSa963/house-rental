<?php

namespace App\Policies;

use App\Models\House;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class HousePolicy
{
    use HandlesAuthorization;

    public function view(?User $user, House $house)
    {
        return $house->active || ($user && $house->user_id == $user->id);
    }

    public function update(User $user, House $house)
    {
        return $user->id == $house->user_id;
    }

    public function delete(User $user, House $house)
    {
        return $user->id == $house->user_id;
    }
}
