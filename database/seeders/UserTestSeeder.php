<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use App\Models\Report;
use App\Models\SubDivision;
use Illuminate\Database\Seeder;

class UserTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SubDivision::all()->map( function( $subDivision ) {

            // kaunit
            if ( $subDivision->id % 2 != 0 ) {
                User::factory()->create(['sub_division_id' => $subDivision->id])->assignRole('kaunit');
            }

            // spv
            User::factory()->create(['sub_division_id' => $subDivision->id])->assignRole('spv');
            
            User::factory()->count(3)->create(['sub_division_id' => $subDivision->id])
                ->map( function( $user ) {
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

        // this seeding will create:
        // 10 USERS, assign them as STAFF
        // create 1 REPORT for each of them
        // each REPORT has 10 POST
        // and generous random amount of ATTACHMENTS per POST
        $users = User::factory()->count(10)->create();
        $users->each( function( $user ) {
            $user->assignRole('staff');
            $division = $user->load('subDivision.Division')->subDivision->division;
            $report = Report::factory()->create([
                'division_id' => $division
            ]);
            $attachmentsQty = rand(1, 10);
            Post::factory()->count(10)->for(User::find(1))->hasAttachments( $attachmentsQty )->create([
                'report_id' => $report->id
            ]);
        } );
    }
}
