<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use App\Models\User;

class RolesPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create roles and assign existing permissions
            $role   = Role::create(['name' => 'root']);

        // Create root user
            $user = User::create([
                'first_name' => 'User',
                'last_name'  => 'Admin',
                'email'    => 'useradmin@mail.com',
                'password' => bcrypt('qwerty123'),
                'status' => 1
            ]);
            $user->assignRole($role);
    }
}
