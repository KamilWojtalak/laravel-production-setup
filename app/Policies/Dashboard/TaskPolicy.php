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
        if ($user->canCreateTask())
        {
            return true;
        }

        return false;
    }
}
