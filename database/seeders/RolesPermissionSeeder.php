<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
//use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use App\Models\User;
use App\Models\Role;

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
            $role1   = Role::create(['name' => 'executive_administrator', 'description' => 'Administrador Ejecutivo']);
            $role2   = Role::create(['name' => 'legal_administrator', 'description' => 'Administrador Legal']);
            $role3   = Role::create(['name' => 'legal_executive', 'description' => 'Ejecutivo Legal']);
            $role4   = Role::create(['name' => 'collection_executive', 'description' => 'Ejecutivo Cobranza']);

        // Create executive administrator
            $user = User::create([
                'first_name' => 'Administrador',
                'last_name'  => 'Ejecutivo',
                'email'    => 'adminejecutivo@mail.com',
                'password' => bcrypt('qwerty123'),
                'status' => 1
            ]);
            $user->assignRole($role1);

        //Create legal administrator
            $user1 = User::create([
                'first_name' => 'Administrador',
                'last_name'  => 'Legal',
                'email'    => 'adminlegal@mail.com',
                'password' => bcrypt('qwerty123'),
                'status' => 1
            ]);
            $user1->assignRole($role2);
    }
}
