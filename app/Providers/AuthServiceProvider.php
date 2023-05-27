<?php

namespace App\Providers;

use App\Models\Contract;
use App\Models\House;
use App\Models\HouseReview;
use App\Policies\ContractPolicy;
use App\Policies\HousePolicy;
use App\Policies\HouseReviewPolicy;
// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        House::class => HousePolicy::class,
        HouseReview::class => HouseReviewPolicy::class,
        Contract::class => ContractPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
}
