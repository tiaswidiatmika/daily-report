<?php

  namespace App\Traits;

  trait UserCustomPermissions
  {
      public $permissions = [
        'manage users' => [
            'create users',
            'edit users',
            'delete users',
            'view users',
        ],
        'manage users status' => [
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
    ];
  }