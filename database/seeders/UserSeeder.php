<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                "role" => 1,
                "name" => "Demo Teacher",
                "email" => "teacher@demo.com",
                "email_verified_at" => Carbon::now(),
                "password" => Hash::make('demoteacher'),
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now()
            ],
            [
                "role" => 2,
                "name" => "Demo Student",
                "email" => "student@demo.com",
                "email_verified_at" => Carbon::now(),
                "password" => Hash::make('demostudent'),
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now()
            ]
        ]);
    }
}
