<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        User::create([
            "user_role_id" => 1,
            "name" => "admin",
            "email" => "admin@gmail.com",
            "phone" => "01600000000",
            "password" => Hash::make("adminadmin"),
        ]);
    }
}
