<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;

class CreateRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = array(
            [
                'id' => '2',
                'name'=>'Teacher'
            ],
            [
                'id' => '3',
                'name'=>'Student'
            ],
        );
        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
