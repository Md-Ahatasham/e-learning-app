<?php

namespace Database\Seeders;

use App\Models\Rounder;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CreateRounderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rounders = array(
            [
                'user_id' => 2,
                'dob' => Carbon::now(),
                'age' => 30,
                'gender' => 'male',
                'preferred_language' => 'english',
                'address' => '657 Pennsylvania Lane Alhambra, CA 91801',
                'phone_number' => '01748569523',
                'emergency_contact' => '01254856963',
                'academic_details' => 'graduated from school of economics,hannan university',
                'specialist' => 'ent',
                'assign_tab' => 'iPad Pro-11',

            ],

            [
                'user_id' => 3,
                'dob' => Carbon::now(),
                'age' => 40,
                'gender' => 'male',
                'preferred_language' => 'english',
                'address' => '657 Pennsylvania Lane Alhambra, CA 91801',
                'phone_number' => '01748569523',
                'emergency_contact' => '01254856963',
                'academic_details' => 'graduated from school of economics,hannan university',
                'specialist' => 'ent',
                'assign_tab' => 'iPad Pro-12',

            ],
            [
                'user_id' => 4,
                'dob' => Carbon::now(),
                'age' => 50,
                'gender' => 'male',
                'preferred_language' => 'english',
                'address' => '657 Pennsylvania Lane Alhambra, CA 91801',
                'phone_number' => '01748569523',
                'emergency_contact' => '01254856963',
                'academic_details' => 'graduated from school of economics,hannan university',
                'specialist' => 'ent',
                'assign_tab' => 'iPad Pro-12',

            ],
            [
                'user_id' => 5,
                'dob' => Carbon::now(),
                'age' => 55,
                'gender' => 'male',
                'preferred_language' => 'english',
                'address' => '657 Pennsylvania Lane Alhambra, CA 91801',
                'phone_number' => '01748569523',
                'emergency_contact' => '01254856963',
                'academic_details' => 'graduated from school of economics,hannan university',
                'specialist' => 'ent',
                'assign_tab' => 'iPad Pro-11',

            ],
        );
        foreach ($rounders as $rounder) {
            Rounder::create($rounder);
        }
    }
}
