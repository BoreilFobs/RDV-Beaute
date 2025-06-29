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
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Boreil',
            'email' => 'fobsboreil@gmail.com',
            'phone' => '650043200',
            'password' => bcrypt('0000000000'),
            'role' => 'admin',
        ]);
    }
}
