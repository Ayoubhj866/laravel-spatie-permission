<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        //** create users and assign it roles */
        User::create([
            'name' => 'user' ,
            'email' => 'user@gmail.com' ,
            'password' => Hash::make('password')  ,
        ])->assignRole("user") ;

    }
}
