<?php

namespace Database\Seeders;

use App\Models\Notification;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Notification::truncate();
        Notification::create([
            "title" => Str::random(10),
            "description" => Str::random(50),
            "image" => "avatar.png",
            "blog_id" => 1,
            "external_link" => Str::random(20)."com",
        ]);
    }
}
