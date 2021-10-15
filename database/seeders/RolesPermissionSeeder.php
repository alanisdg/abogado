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
            $role5   = Role::create(['name' => 'customer', 'description' => 'Cliente']);

        // Create executive administrator
            $user = User::create([
                'first_name' => 'Administrador',
                'last_name'  => 'Ejecutivo',
                'email'    => 'horacio@gmail.com',
                'password' => bcrypt('password'),
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

        //Create legal executive
            $user2 = User::create([
                'first_name' => 'Ejecutivo',
                'last_name'  => 'Legal',
                'email'    => 'ejecutivolegal@mail.com',
                'password' => bcrypt('qwerty123'),
                'status' => 1
            ]);
            $user2->assignRole($role3);

        //Create collections executive
            $user3 = User::create([
                'first_name' => 'Ejecutivo',
                'last_name'  => 'Cobranza',
                'email'    => 'ejecutivocobranza@mail.com',
                'password' => bcrypt('qwerty123'),
                'status' => 1
            ]);
            $user3->assignRole($role4);
    }
}
