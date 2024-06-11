<?php

namespace Database\Seeders;

use App\Models\Job;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        User::firstOrCreate([
            'email' => 'whokilledmydog@revenge.com',
        ], [
            'name' => 'John Wick',
            'email' => 'whokilledmydog@revenge.com',
            'password' => Hash::make('secret'),
        ]);
         $this->call(JobSeeder::class);
    }   
}
