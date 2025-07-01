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
            'name' => 'susie',
            'email' => 'admin@admin.com',
            'phone' => '650043200',
            'password' => bcrypt('glowandchicadmin'),
            'role' => 'admin',
        ]);
        User::factory()->create([
            'name' => 'test',
            'email' => 'test@test.com',
            'phone' => '650043210',
            'password' => bcrypt('test'),
        ]);
    }
}
