<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::truncate();
        Setting::create([
            "system_name" => "Site Name",
            "app_version" => "1",
            "mail_address" => "admin@admin.com",
            "update_app" => "1",
            "developed_by" => "Project X Lmt",
            "facebook" => "facebook.com",
            "instagram" => "instagram.com",
            "twitter" => "twitter.com",
            "youtube" => "youtube.com",
            "copyright" => Str::random(50)."copyright",
            "image" => "logo.png",
            "description" => Str::random(20),
            "privacy_policy" =>Str::random(20),
            "cookies_policy" => Str::random(2),
            "terms_policy" => Str::random(20),
        ]);
    }
}
