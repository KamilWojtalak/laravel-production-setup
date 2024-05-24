<?php

namespace Database\Seeders;

use App\Models\Plan;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    public function run(): void
    {
        Plan::factory()->create([
            'name' => 'first-test-plan',
            'strength' => 5,
        ]);

        Plan::factory()->create([
            'name' => 'second-test-plan',
            'strength' => 10,
        ]);
    }
}
