<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Factories\UserFactory;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()
            ->count(5)
            ->unverified()
            ->create();
        
        User::factory()
            ->count(2)
            ->admin()
            ->unverified()
            ->create();
        
        User::factory()
            ->superAdmin()
            ->unverified()
            ->create();
    }
}