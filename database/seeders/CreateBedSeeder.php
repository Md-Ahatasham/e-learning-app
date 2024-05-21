<?php

namespace Database\Seeders;

use App\Models\Bed;
use Illuminate\Database\Seeder;

class CreateBedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $beds = array(
            [
                'room_id' => '1',
                 'bed_no'=>'300'
            ],
            [
                'room_id' => '1',
                'bed_no'=>'301'
            ],
        );
        foreach ($beds as $bed) {
            Bed::create($bed);
        }
    }
}
