<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
//            'notification-list',
//            'notification-create',
//            'notification-edit',
//            'notification-delete',
            'student-list',
            'student-create',
            'student-edit',
            'student-delete',
            'teacher-list',
            'teacher-create',
            'teacher-edit',
            'teacher-delete',
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'location-list',
            'location-create',
            'location-edit',
            'location-delete',
            'behavior-list',
            'behavior-create',
            'behavior-edit',
            'behavior-delete',
            'affect-list',
            'affect-create',
            'affect-edit',
            'affect-delete',
            'log-list',
            'log-delete',
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'report-list',
            'permission-list',
            'permission-create',
            'permission-edit',
            'permission-delete',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
        $role = Role::where(['name' => 'Admin'])->first();
        $permissions = Permission::pluck('id', 'id')->all();
        $role->syncPermissions($permissions);
        $user = User::where('email','admin@gmail.com')->first();
        $user->assignRole([$role->id]);
    }
}
