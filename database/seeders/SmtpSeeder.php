<?php

namespace Database\Seeders;

use App\Models\Smtp;
use Illuminate\Database\Seeder;

class SmtpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Smtp::truncate();
        Smtp::create([
            "name" => 'smtp',
            "host" => "smtp.mailtrap.io",
            "port" => "2525",
            "username" => "70095290a165f2",
            "email" => "70095290a165f2",
            "password" => "85bbb312fc39f2",
            "encryption" => "tls",
        ]);
    }
}
