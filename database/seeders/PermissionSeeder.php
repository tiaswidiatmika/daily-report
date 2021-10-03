<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\{Permission, Role};

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // seeding permission, boleh nemu dari https://spatie.be/docs/laravel-permission/v5/advanced-usage/seeding
        // reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = collect([
            'manage users' => [
                'create users',
                'edit users',
                'delete users',
                'view users',
                'edit users status',
            ],
            'manage posts' => [
                'create posts',
                'edit posts',
                'delete posts',
                'view posts',
            ],
            'manage templates' => [
                'create templates',
                'edit templates',
                'delete templates',
                'view templates',
            ],
            'manage presence' => [
                'create presence',
                'edit presence',
                'delete presence',
                'view presence',
            ],
            'manage reports' => [
                'create reports',
                'edit reports',
                'delete reports',
                'view reports',
            ],
            'manage sections' => [
                'create sections',
                'edit sections',
                'delete sections',
                'view sections',
            ],
        ]);

        $permissions->map( function($abilities) {
            foreach ($abilities as $ability) {
                Permission::create(['name' => $ability]);
            }
        } );

        $admin = Role::create(['name' => 'admin'])
            ->syncPermissions($permissions->flatten());

        $kaunit = Role::create(['name' => 'kaunit'])
            ->syncPermissions( $permissions->except('manage users')->flatten() );

        $spv = Role::create(['name' => 'spv'])
            ->syncPermissions( $permissions->except(['manage users', 'manage reports'])->flatten() );

        $asistenSpv = Role::create(['name' => 'asisten_spv'])
            ->syncPermissions( $permissions->except(['manage users', 'manage reports'])->flatten() );

        $staff = Role::create(['name' => 'staff'])
            ->syncPermissions( $permissions->only(['manage templates', 'manage presence', 'manage sections'])->flatten() );
            
        $honorer = Role::create(['name' => 'honorer']);


        
    }
}
