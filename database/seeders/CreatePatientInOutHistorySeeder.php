<?php

namespace Database\Seeders;

use App\Models\PatientInOutHistory;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CreatePatientInOutHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $patientHistory = array(
            [
                'patient_id' => "1",
                'admission_date' => Carbon::now(),
                'discharged_date' => NULL,
                'entry_by'=>1
            ],
            [
                'patient_id' => "4",
                'admission_date' => Carbon::now(),
                'discharged_date' => NULL,
                'entry_by'=>1
            ],
            [
                'patient_id' => "5",
                'admission_date' => Carbon::now(),
                'discharged_date' => NULL,
                'entry_by'=>1
            ],
            [
                'patient_id' => "2",
                'admission_date' => Carbon::now(),
                'discharged_date' => NULL,
                'entry_by'=>1
            ],
            [
                'patient_id' => "3",
                'admission_date' => Carbon::now(),
                'discharged_date' => NULL,
                'entry_by'=>1
            ],
        );
        foreach ($patientHistory as $history) {
            PatientInOutHistory::create($history);
        }
    }
}
