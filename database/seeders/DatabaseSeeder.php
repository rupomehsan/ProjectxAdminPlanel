<?php

namespace Database\Seeders;


use App\Models\Role;
use App\Models\Smtp;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            UserSeeder::class,
            BlogSeeder::class,
            NotificationSeeder::class,
            SettingsSeeder::class,
            SmtpSeeder::class,
            RoleSeeder::class,
        ]);
    }
}
