<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        User::factory()->create([
            'name' => 'dev8',
            'email' => 'dev8@pro.com',
            'password' => '12345678',
            'user_type' => 'admin',
            'phone' => '888',
        ]);
    }
}
