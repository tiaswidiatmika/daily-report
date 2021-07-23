<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
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
        User::create([
            'alias' => 'Sembara',
            'name' => 'Nengah Sembara',
            'nip' => '199105082017121001',
            'email' => 'ngh.sembhara@wayan.nengah',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);
        User::factory()->count(1)->create([
            'role' => 'spv'
        ]);
        User::factory()->count(1)->create([
            'alias' => 'AGhazali',
            'name' => 'Ahmad Ghazali',
            'role' => 'kaunit',
            'nip' => '198703032007011003'
        ]);
        User::factory()->count(3)->create([
            'role' => 'opis'
        ]);
        User::factory()->count(20)->create();

        // User::factory()
        //     ->count(2)
        //     ->hasPosts(5)
        //     ->create();
    }
}
