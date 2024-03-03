<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            1 => 'superadmin',
            2 => 'admin',
        ];

        foreach ($roles as $roleId => $roleName) {
            Role::create(['id' => $roleId,'name' => $roleName,'guard_name'=>'admin']);
        }

        // Create Superadmin
        $superadmin = Admin::create([
            'name' => 'Superadmin',
            'email' => 'superadmin@dev.com',
            'password' => 'superadmin@dev.com',
            'role_id' => 1,
        ]);
        $superadmin->assignRole($superadmin->role->name);

        // Create Admin
        $admin = Admin::create([
            'name' => 'Admin',
            'email' => 'admin@dev.com',
            'password' => 'admin@dev.com',
            'role_id' => 2,
        ]);
        $admin->assignRole($admin->role->name);
    }
}
