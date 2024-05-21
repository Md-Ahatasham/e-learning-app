<?php

namespace Database\Seeders;

use App\Models\PatientPreCaution;
use Illuminate\Database\Seeder;

class CreatePatientHasPrecaution extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $patientHasPrecautions = array(
            [
                'patient_id' => "1",
                'pre_caution_id' => '1',
                'entry_by' => '1',
            ],
            [
                'patient_id' => "1",
                'pre_caution_id' => '2',
                'entry_by' => '1',
            ],
            [
                'patient_id' => "1",
                'pre_caution_id' => '3',
                'entry_by' => '1',
            ],
            [
                'patient_id' => "2",
                'pre_caution_id' => '2',
                'entry_by' => '1',
            ],
            [
                'patient_id' => "2",
                'pre_caution_id' => '3',
                'entry_by' => '1',
            ],

            [
                'patient_id' => "3",
                'pre_caution_id' => '2',
                'entry_by' => '1',
            ],
            [
                'patient_id' => "3",
                'pre_caution_id' => '4',
                'entry_by' => '1',
            ],

            [
                'patient_id' => "4",
                'pre_caution_id' => '1',
                'entry_by' => '1',
            ],
            [
                'patient_id' => "4",
                'pre_caution_id' => '2',
                'entry_by' => '1',
            ],
            [
                'patient_id' => "5",
                'pre_caution_id' => '4',
                'entry_by' => '1',
            ],
        );
        foreach ($patientHasPrecautions as $patientHasPrecaution) {
            PatientPreCaution::create($patientHasPrecaution);
        }
    }
}
