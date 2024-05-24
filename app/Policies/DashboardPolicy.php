<?php

namespace App\Policies;

use App\Models\User;

class DashboardPolicy
{
    public function __construct()
    {
        //
    }

    public function firstPlan(User $user): bool
    {
        return $user->hasThisPlanMinimum('first-test-plan');
    }

    public function secondPlan(User $user): bool
    {
        return $user->hasThisPlanMinimum('second-test-plan');
    }
}
