<?php

namespace Database\Seeders;

use App\Models\PatientTransferHistory;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CreatePatientHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $patientTransferHistory = array(
            [
                'previous_rounder_id' => 0,
                'current_rounder_id' => 2,
                'patient_id' => 1,
                'transfer_status' => '0',
                'entry_by' => 1,
            ],
            [
                'previous_rounder_id' => 0,
                'current_rounder_id' => 3,
                'patient_id' => 2,
                'transfer_status' => '0',
                'entry_by' => 1,
            ],

            [
                'previous_rounder_id' => 0,
                'current_rounder_id' => 4,
                'patient_id' => 3,
                'transfer_status' => '0',
                'entry_by' => 1,
            ],

            [
                'previous_rounder_id' => 0,
                'current_rounder_id' => 5,
                'patient_id' =>4 ,
                'transfer_status' => '0',
                'entry_by' => 1,
            ],
            [
                'previous_rounder_id' => 0,
                'current_rounder_id' => 2,
                'patient_id' => 5,
                'transfer_status' => '0',
                'entry_by' => 1,
            ],
            [
                'previous_rounder_id' => 0,
                'current_rounder_id' => 2,
                'patient_id' => 6,
                'transfer_status' => '0',
                'entry_by' => 1,
            ],
            [
                'previous_rounder_id' => 0,
                'current_rounder_id' => 3,
                'patient_id' => 7,
                'transfer_status' => '0',
                'entry_by' => 1,
            ],
        );
        foreach ($patientTransferHistory as $history) {
            PatientTransferHistory::create($history);
        }
    }
}
