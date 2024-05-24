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
        if ($user->hasNotThisPlanMinimum('first-test-plan'))
        {
            return false;
        }

        $month = now()->subMonth();

        if ($user->hasPayedForPlanSince($month))
        {
            return true;
        }

        return false;
    }

    public function secondPlan(User $user): bool
    {
        if ($user->hasNotThisPlanMinimum('second-test-plan'))
        {
            return false;
        }

        $month = now()->subMonth();

        if ($user->hasPayedForPlanSince($month))
        {
            return true;
        }

        return false;
    }
}
