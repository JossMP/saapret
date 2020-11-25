<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class UsersSeeder extends Seeder
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

        // permissions
        Permission::create(['name' => 'users-create']);
        Permission::create(['name' => 'users-read']);
        Permission::create(['name' => 'users-update']);
        Permission::create(['name' => 'users-delete']);

        // create roles and assign existing permissions
        $role1 = Role::create(['name' => 'super-admin']); //all

        $role2 = Role::create(['name' => 'admin']);
        $role2->givePermissionTo('users-create');
        $role2->givePermissionTo('users-read');
        $role2->givePermissionTo('users-update');
        $role2->givePermissionTo('users-delete');

        $role3 = Role::create(['name' => 'user']);


        //
        $user1 = User::create([
            'name'              => 'Super Administrador',
            'email'             => 'admin@alecomled.com',
            'username'          => 'superadmin',
            'email_verified_at' => now(),
            'password'          => Hash::make('Clave!"#3'),
            'api_token'         => Str::random(60),
            'remember_token'    => Str::random(10),
            'avatar'            => 'default.png'
        ]);
        $user1->assignRole($role1);

        $user2 = User::create([
            'name'              => 'Administrador',
            'email'             => 'jossmp@alecomled.com',
            'username'          => 'jossmp',
            'email_verified_at' => now(),
            'password'          => Hash::make('Clave!"#3'),
            'api_token'         => Str::random(60),
            'remember_token'    => Str::random(10),
            'avatar'            => 'default.png',
            'user_id'           => $user1->id,
        ]);
        $user2->assignRole($role2);

        $user3 = User::create([
            'name'              => 'Usuario',
            'email'             => 'user@alecomled.com',
            'username'          => 'username',
            'email_verified_at' => now(),
            'password'          => Hash::make('Clave!"#3'),
            'api_token'         => Str::random(60),
            'remember_token'    => Str::random(10),
            'avatar'            => 'default.png',
            'user_id'           => $user2->id,
        ]);
        $user3->assignRole($role3);
    }
}
