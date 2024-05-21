<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CreateAdminUserSeeder extends Seeder
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
                'first_name' => 'Tom',
                'last_name' => 'Hanks',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('12345678'),
                'status' => '1',
                'role_id' => '1',
                'profile_photo' => asset('dist/img/default_avatar.png'),
                'user_code' => 123,
            ],
        );
        $role = Role::create(['name' => 'Admin']);
        $permissions = Permission::pluck('id', 'id')->all();
        $role->syncPermissions($permissions);
        $user->assignRole([$role->id]);
    }
}
