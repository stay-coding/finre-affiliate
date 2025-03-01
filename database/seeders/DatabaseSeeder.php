<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Create roles
        $admin = Role::create(['name' => 'admin', 'guard_name' => 'web']);
        $afiliator = Role::create(['name' => 'afiliator', 'guard_name' => 'web']);

        // Create permissions
        $admin_permission = Permission::create(['name' => 'admin-things', 'guard_name' => 'web']);
        $afiliator_permission = Permission::create(['name' => 'afiliator-things', 'guard_name' => 'web']);

        // Assign permissions to roles admin
        $admin->givePermissionTo($admin_permission);
        $admin_permission->assignRole($admin);

        // Assign permissions to roles afiliator
        $afiliator->givePermissionTo($afiliator_permission);
        $afiliator_permission->assignRole($afiliator);

        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@email.com',
            'password' => Hash::make('123456'),
        ]);

        $user->assignRole('admin');
    }
}
