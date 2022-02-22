<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $users = [
            ["name" => "Admin", "email" => "admin@technojs.com", "password" => "@Admin@Image*#691587#*@2022@Go", "role" => "admin"],
            ["name" => "Creator", "email" => "creator@technojs.com", "password" => "@Creator@Image@@2022@@Go", "role" => "creator"],
            ["name" => "Guest", "email" => "guest@technojs.com", "password" => "@Guest@Image@2022@", "role" => "guest"],

        ];
        foreach ($users as $user) {
            $u = \App\Models\User::create($user);
            $u->markEmailAsVerified();
        }

        // \App\Models\User::factory()->count(1)->hasImages(50)->create();
    }
}
