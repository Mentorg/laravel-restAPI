<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Misc
        $miscPermission = Permission::create(['name' => "N/A"]);

        // User Model
        $userPermission1 = Permission::create(['name' => "list: user"]);
        $userPermission2 = Permission::create(['name' => "read: user"]);
        $userPermission3 = Permission::create(['name' => "update: user"]);
        $userPermission4 = Permission::create(['name' => "delete: user"]);

        // Article Model
        $articlePermission1 = Permission::create(['name' => "list: article"]);
        $articlePermission2 = Permission::create(['name' => "create: article"]);
        $articlePermission3 = Permission::create(['name' => "read: article"]);
        $articlePermission4 = Permission::create(['name' => "update: article"]);
        $articlePermission5 = Permission::create(['name' => "delete: article"]);

        // Role Model
        $rolePermission1 = Permission::create(['name' => "list: role"]);
        $rolePermission2 = Permission::create(['name' => "create: role"]);
        $rolePermission3 = Permission::create(['name' => "read: role"]);
        $rolePermission4 = Permission::create(['name' => "update: role"]);
        $rolePermission5 = Permission::create(['name' => "delete: role"]);

        // Permission Model
        $permission1 = Permission::create(['name' => "list: permission"]);
        $permission2 = Permission::create(['name' => "create: permission"]);
        $permission3 = Permission::create(['name' => "read: permission"]);
        $permission4 = Permission::create(['name' => "update: permission"]);
        $permission5 = Permission::create(['name' => "delete: permission"]);

        // Create Roles
        $userRole = Role::create(['name' => "user"])->syncPermissions([
            $miscPermission,
        ]);

        $adminRole = Role::create(['name' => "admin"])->syncPermissions([
            $userPermission1,
            $userPermission2,
            $userPermission3,
            $userPermission4,
            $articlePermission1,
            $articlePermission2,
            $articlePermission3,
            $articlePermission4,
            $articlePermission5,
            $rolePermission1,
            $rolePermission2,
            $rolePermission3,
            $rolePermission4,
            $rolePermission5,
            $permission1,
            $permission2,
            $permission3,
            $permission4,
            $permission5,
        ]);
        $editorRole = Role::create(['name' => "editor"])->syncPermissions([
            $articlePermission1,
            $articlePermission2,
            $articlePermission3,
            $articlePermission4,
            $articlePermission5,
        ]);

        // Create staff & users
        User::create([
            'name' => "admin",
            'is_admin' => 1,
            'email' => "admin@admin.com",
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ])->assignRole($adminRole);

        User::create([
            'name' => "editor",
            'is_admin' => 1,
            'email' => "editor@admin.com",
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ])->assignRole($editorRole);

        for ($i = 1; $i < 25; $i++) {
            User::create([
                'name' => "Test " . $i,
                'is_admin' => 0,
                'email' => "test".$i."@test.com",
                'email_verified_at' => now(),
                'password' => Hash::make('password'), // password
                'remember_token' => Str::random(10),
            ])->assignRole($userRole);
        }
    }
}
