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
        return $user->hasPlanByName('first-test-plan');
    }

    public function secondPlan(User $user): bool
    {
        return $user->hasPlanByName('second-test-plan');
    }
}
