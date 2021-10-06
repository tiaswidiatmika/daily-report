<?php

namespace Database\Seeders;

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
        // relationship 1: shift->report->post->attachment
        // relationship 2: user->subDivision->division->report->shift
        // template seeder will be called as initial template
        $this->call([
            PermissionSeeder::class, 
            UserTestSeeder::class, // seed db with users, their teammates, reports, and posts
            // ReportSeeder::class,
            TemplateSeeder::class,
            // PostSeeder::class,
            PositionSeeder::class, 
        ]);
    }
}
