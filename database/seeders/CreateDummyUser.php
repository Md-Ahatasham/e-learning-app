<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class CreateDummyUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = array(
            [
                'first_name' => 'Barak',
                'last_name' => 'Obama',
                'email' => 'barak@gmail.com',
                'password' => bcrypt('12345678'),
                'status' => '1',
                'role_id' => '2',
                'is_online' => '1',
                'profile_photo' => asset('dist/img/default_avatar.png'),
                'user_code' => 12345,
            ],
            [
                'first_name' => 'Jhone',
                'last_name' => 'Cena',
                'email' => 'cena@gmail.com',
                'password' => bcrypt('12345678'),
                'status' => '1',
                'role_id' => '2',
                'is_online' => '1',
                'profile_photo' => asset('dist/img/default_avatar.png'),
                'user_code' => 123456,
            ],
            [
                'first_name' => 'The',
                'last_name' => 'Rock',
                'email' => 'rock@gmail.com',
                'password' => bcrypt('12345678'),
                'status' => '1',
                'role_id' => '2',
                'is_online' => '1',
                'profile_photo' => asset('dist/img/default_avatar.png'),
                'user_code' => 1234567,
            ],
            [
                'first_name' => 'Jhonson',
                'last_name' => 'Boris',
                'email' => 'boris@gmail.com',
                'password' => bcrypt('12345678'),
                'status' => '1',
                'role_id' => '2',
                'is_online' => '0',
                'profile_photo' => asset('dist/img/default_avatar.png'),
                'user_code' => 12345678,
            ],

        );
        foreach ($users as $user) {
            User::create($user);
        }
    }
}
