<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class CreateUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create(
            [
                'first_name' => 'Jhon',
                'last_name' => 'Smith',
                'email' => 'smith@gmail.com',
                'password' => bcrypt('12345678'),
                'status' => '1',
                'role_id' => '2',
                'profile_photo' => asset('dist/img/default_avatar.png'),
                'user_code' => 1234,
                'hospital_code' => 123456,
            ],

        );

        $role = Role::create(['name' => 'Rounder']);
        $permissions = Permission::pluck('id', 'id')->all();
        $role->syncPermissions($permissions);
        $user->assignRole([$role->id]);
    }
}
