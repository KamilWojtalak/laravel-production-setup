<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            PlanSeeder::class,
        ]);

        User::factory()->create([
            'name' => 'Kamil Wojtalak',
            'email' => 'kontakt@wojtalak.com',
        ]);

        // User::factory(10)->create();
    }
}
