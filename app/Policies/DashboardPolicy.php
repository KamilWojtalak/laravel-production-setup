<?php

namespace App\Policies;

use App\Models\Plan;
use App\Models\User;

class DashboardPolicy
{
    public function __construct()
    {
        //
    }

    public function firstPlan(User $user): bool
    {
        if ($user->hasNotThisPlanMinimum(Plan::TYPE_FIRST))
        {
            return false;
        }

        if ($user->hasPayedForPlanSinceMonth())
        {
            return true;
        }

        return false;
    }

    public function secondPlan(User $user): bool
    {
        if ($user->hasNotThisPlanMinimum(PLAN::TYPE_SECOND))
        {
            return false;
        }

        if ($user->hasPayedForPlanSinceMonth())
        {
            return true;
        }

        return false;
    }
}
