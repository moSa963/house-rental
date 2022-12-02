<?php

namespace App\Policies;

use App\Models\House;
use App\Models\User;
use App\Services\HouseService;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Date;

class HouseReviewPolicy
{
    use HandlesAuthorization;

    public function create(User $user, House $house)
    {
        return HouseService::userCanAddReview($user, $house);
    }
}
