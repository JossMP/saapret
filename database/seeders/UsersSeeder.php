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
        // CRUD
        // permissions Users
        Permission::create(['name' => 'users.create']);
        Permission::create(['name' => 'users.read']);
        Permission::create(['name' => 'users.update']);
        Permission::create(['name' => 'users.delete']);
        // permissions People
        Permission::create(['name' => 'people.create']);
        Permission::create(['name' => 'people.read']);
        Permission::create(['name' => 'people.update']);
        Permission::create(['name' => 'people.delete']);
        // permissions Careers
        Permission::create(['name' => 'careers.create']);
        Permission::create(['name' => 'careers.read']);
        Permission::create(['name' => 'careers.update']);
        Permission::create(['name' => 'careers.delete']);
        // permissions Degrees
        Permission::create(['name' => 'degrees.create']);
        Permission::create(['name' => 'degrees.read']);
        Permission::create(['name' => 'degrees.update']);
        Permission::create(['name' => 'degrees.delete']);
        // permissions Professions
        Permission::create(['name' => 'professions.create']);
        Permission::create(['name' => 'professions.read']);
        Permission::create(['name' => 'professions.update']);
        Permission::create(['name' => 'professions.delete']);
        // permissions specialties
        Permission::create(['name' => 'specialties.create']);
        Permission::create(['name' => 'specialties.read']);
        Permission::create(['name' => 'specialties.update']);
        Permission::create(['name' => 'specialties.delete']);
        // permissions Graduates
        Permission::create(['name' => 'graduates.create']);
        Permission::create(['name' => 'graduates.read']);
        Permission::create(['name' => 'graduates.update']);
        Permission::create(['name' => 'graduates.delete']);
        // permissions Experiences
        Permission::create(['name' => 'experiences.create']);
        Permission::create(['name' => 'experiences.read']);
        Permission::create(['name' => 'experiences.update']);
        Permission::create(['name' => 'experiences.delete']);
        // permissions Certificates
        Permission::create(['name' => 'certificates.create']);
        Permission::create(['name' => 'certificates.read']);
        Permission::create(['name' => 'certificates.update']);
        Permission::create(['name' => 'certificates.delete']);


        // create roles and assign existing permissions
        $role1 = Role::create(['name' => 'super-admin']); //all

        $role2 = Role::create(['name' => 'admin']);

        $role2->givePermissionTo('users.create');
        $role2->givePermissionTo('users.read');
        $role2->givePermissionTo('users.update');
        $role2->givePermissionTo('users.delete');

        $role2->givePermissionTo('people.create');
        $role2->givePermissionTo('people.read');
        $role2->givePermissionTo('people.update');
        $role2->givePermissionTo('people.delete');

        $role2->givePermissionTo('careers.create');
        $role2->givePermissionTo('careers.read');
        $role2->givePermissionTo('careers.update');
        $role2->givePermissionTo('careers.delete');

        $role2->givePermissionTo('degrees.create');
        $role2->givePermissionTo('degrees.read');
        $role2->givePermissionTo('degrees.update');
        $role2->givePermissionTo('degrees.delete');

        $role2->givePermissionTo('professions.create');
        $role2->givePermissionTo('professions.read');
        $role2->givePermissionTo('professions.update');
        $role2->givePermissionTo('professions.delete');

        $role2->givePermissionTo('specialties.create');
        $role2->givePermissionTo('specialties.read');
        $role2->givePermissionTo('specialties.update');
        $role2->givePermissionTo('specialties.delete');

        $role2->givePermissionTo('graduates.create');
        $role2->givePermissionTo('graduates.read');
        $role2->givePermissionTo('graduates.update');
        $role2->givePermissionTo('graduates.delete');

        $role2->givePermissionTo('experiences.create');
        $role2->givePermissionTo('experiences.read');
        $role2->givePermissionTo('experiences.update');
        $role2->givePermissionTo('experiences.delete');

        $role2->givePermissionTo('certificates.create');
        $role2->givePermissionTo('certificates.read');
        $role2->givePermissionTo('certificates.update');
        $role2->givePermissionTo('certificates.delete');


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
