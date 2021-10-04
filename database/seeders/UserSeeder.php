<?php

namespace Database\Seeders;

use App\Models\{Division, SubDivision, User};
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

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
            'sub_division_id' => '7',
            'alias' => 'Sembara',
            'name' => 'Nengah Sembara',
            'nip' => '199105082017121001',
            'email' => 'ngh.sembhara@wayan.nengah',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ])->assignRole('admin');
        
        
        // create user per subdivision
        // create kaunit per if subdivision id is odd
        SubDivision::all()->map( function( $subDivision ) {

            // kaunit
            if ( $subDivision->id % 2 != 0 ) {
                User::factory()->create([
                    'sub_division_id' => $subDivision->id,
                    'alias' => 'AGhazali',
                    'name' => 'Ahmad Ghazali' . ' grup ' . $subDivision->division()->first()->name,
                    'nip' => '19870303 200701 1 003'
                ])->assignRole('kaunit');
            }

            // spv
            User::factory()->count(1)->create([
                'sub_division_id' => $subDivision->id
            ])->map( function( $user ) {
                return $user->assignRole('spv');
            } );
            
            User::factory()->count(3)->create([
                'sub_division_id' => $subDivision->id
            ])->map( function( $user ) {
                return $user->assignRole('asisten_spv');
            } );

            // honorer
            User::factory()->count(4)->create([
                'sub_division_id' => $subDivision->id
            ])->map( function( $user ) {
                return $user->assignRole('honorer');
            } );

            // staff
            User::factory()->count(4)->create([
                'sub_division_id' => $subDivision->id
            ])->map( function( $user ) {
                return $user->assignRole('staff');
            } );

        } );

        // User::factory()
        //     ->count(2)
        //     ->hasPosts(5)
        //     ->create();
    }
}
