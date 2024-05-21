<?php

namespace Database\Seeders;

use App\Models\RounderActivityLog;
use Illuminate\Database\Seeder;

class CreateRoundingActivityLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $activityLog = array(
            [
                'rounder_id' => 3,
                'tablet_name' => "iPad Pro-11",
                'event' => "Tablet log-in",
                'entry_by' => '3',
            ],

            [
                'rounder_id' => 3,
                'tablet_name' => "iPad Pro-11",
                'event' => "successfully sync",
                'entry_by' => '3',
            ],
            [
                'rounder_id' => 3,
                'tablet_name' => "iPad Pro-11",
                'event' => "Tablet log-out",
                'entry_by' => '3',
            ],

            [
                'rounder_id' => 4,
                'tablet_name' => "iPad Pro-11",
                'event' => "Tablet log-in",
                'entry_by' => '3',
            ],

            [
                'rounder_id' => 4,
                'tablet_name' => "iPad Pro-11",
                'event' => "successfully sync",
                'entry_by' => '3',
            ],
            [
                'rounder_id' => 4,
                'tablet_name' => "iPad Pro-11",
                'event' => "Tablet log-out",
                'entry_by' => '3',
            ],

            [
                'rounder_id' => 2,
                'tablet_name' => "iPad Pro-11",
                'event' => "Tablet log-in",
                'entry_by' => '3',
            ],

            [
                'rounder_id' => 2,
                'tablet_name' => "iPad Pro-11",
                'event' => "successfully sync",
                'entry_by' => '3',
            ],
            [
                'rounder_id' => 5,
                'tablet_name' => "iPad Pro-11",
                'event' => "Tablet log-out",
                'entry_by' => '3',
            ],
        );

        foreach ($activityLog as $row) {
            RounderActivityLog::create($row);
        }
    }
}
