<?php

namespace App\Policies\Dashboard;

use App\Models\Plan;
use App\Models\User;

class TaskPolicy
{
    public function __construct()
    {
        //
    }

    public function store(User $user): bool
    {
        return true;
        // if ($user->hasNotThisPlanMinimum(Plan::TYPE_FIRST))
        // {
        //     return false;
        // }

        // if ($user->hasPayedForPlanSinceMonth())
        // {
        //     return true;
        // }

        // return false;
    }
}
