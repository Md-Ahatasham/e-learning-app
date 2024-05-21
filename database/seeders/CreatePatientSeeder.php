<?php

namespace Database\Seeders;

use App\Models\Patient;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CreatePatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $patients = array(
            [
                'first_name' => "Jhon",
                'last_name' => 'Smith',
                'preferred_name' => 'Jhon Smith',
                'gender' => '1',
                'admission_date' => Carbon::now(),
                'preferred_language' => 'English',
                'dob' => Carbon::now(),
                'age' => 30,
                'address' => '657 Pennsylvania Lane Alhambra, CA 91801',
                'phone_number' => '01748569523',
                'emergency_contact' => '01254856963',
                'unit' => '1',
                'room' => '1',
                'bed' => '1',
                'assigned_rounder_id' => '',
                'admission_notes' => '',
                'entry_by' => 1,
                'interval' => 15,
                'patient_picture' => asset('dist/img/default_avatar.png'),

            ],
            [
                'first_name' => "Belly",
                'last_name' => 'Smith',
                'preferred_name' => 'Belly Smith',
                'gender' => '1',
                'admission_date' => Carbon::now(),
                'preferred_language' => 'English',
                'dob' => Carbon::now(),
                'age' => 30,
                'address' => '657 Pennsylvania Lane Alhambra, CA 91801',
                'phone_number' => '01748569523',
                'emergency_contact' => '01254856963',
                'unit' => '1',
                'room' => '1',
                'bed' => '1',
                'assigned_rounder_id' => '2',
                'admission_notes' => '',
                'entry_by' => 1,
                'interval' => 15,
                'patient_picture' => asset('dist/img/default_avatar.png'),

            ],

            [
                'first_name' => "Hable",
                'last_name' => 'Smith',
                'preferred_name' => 'Hable Smith',
                'gender' => '2',
                'admission_date' => Carbon::now(),
                'preferred_language' => 'English',
                'dob' => Carbon::now(),
                'age' => 30,
                'address' => '657 Pennsylvania Lane Alhambra, CA 91801',
                'phone_number' => '01748569523',
                'emergency_contact' => '01254856963',
                'unit' => '1',
                'room' => '1',
                'bed' => '1',
                'assigned_rounder_id' => '',
                'admission_notes' => '',
                'entry_by' => 1,
                'interval' => 15,
                'patient_picture' => asset('dist/img/default_avatar.png'),

            ],

            [
                'first_name' => "Habllle",
                'last_name' => 'Smithhh',
                'preferred_name' => 'Hable Smithddd',
                'gender' => '1',
                'admission_date' => Carbon::now(),
                'preferred_language' => 'English',
                'dob' => Carbon::now(),
                'age' => 30,
                'address' => '657 Pennsylvania Lane Alhambra, CA 91801',
                'phone_number' => '01748569523',
                'emergency_contact' => '01254856963',
                'unit' => '1',
                'room' => '1',
                'bed' => '1',
                'assigned_rounder_id' => '',
                'admission_notes' => '',
                'entry_by' => 1,
                'interval' => 15,
                'patient_picture' => asset('dist/img/default_avatar.png'),

            ],
            [
                'first_name' => "Hableddd",
                'last_name' => 'Smithffff',
                'preferred_name' => 'Hable Smithfff',
                'gender' => '1',
                'admission_date' => Carbon::now(),
                'preferred_language' => 'English',
                'dob' => Carbon::now(),
                'age' => 30,
                'address' => '657 Pennsylvania Lane Alhambra, CA 91801',
                'phone_number' => '01748569523',
                'emergency_contact' => '01254856963',
                'unit' => '1',
                'room' => '1',
                'bed' => '1',
                'assigned_rounder_id' => '4',
                'admission_notes' => '',
                'entry_by' => 1,
                'interval' => 15,
                'patient_picture' => asset('dist/img/default_avatar.png'),

            ],
            [
                'first_name' => "Hablerrr",
                'last_name' => 'Smithggg',
                'preferred_name' => 'Hable Smithrrr',
                'gender' => '1',
                'admission_date' => Carbon::now(),
                'preferred_language' => 'English',
                'dob' => Carbon::now(),
                'age' => 30,
                'address' => '657 Pennsylvania Lane Alhambra, CA 91801',
                'phone_number' => '01748569523',
                'emergency_contact' => '01254856963',
                'unit' => '1',
                'room' => '1',
                'bed' => '1',
                'assigned_rounder_id' => '4',
                'admission_notes' => '',
                'entry_by' => 1,
                'interval' => 15,
                'patient_picture' => asset('dist/img/default_avatar.png'),

            ],
            [
                'first_name' => "shamlar",
                'last_name' => 'kyle',
                'preferred_name' => 'kyle',
                'gender' => '1',
                'admission_date' => Carbon::now(),
                'preferred_language' => 'English',
                'dob' => Carbon::now(),
                'age' => 30,
                'address' => '657 Pennsylvania Lane Alhambra, CA 91801',
                'phone_number' => '01748569523',
                'emergency_contact' => '01254856963',
                'unit' => '1',
                'room' => '1',
                'bed' => '1',
                'assigned_rounder_id' => '4',
                'admission_notes' => '',
                'entry_by' => 1,
                'interval' => 15,
                'patient_picture' => asset('dist/img/default_avatar.png'),

            ]
        );
        foreach ($patients as $patient) {
            Patient::create($patient);
        }
    }
}
