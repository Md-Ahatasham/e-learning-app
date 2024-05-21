<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Seeder;

class CreateRoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rooms = array(
            [
                'unit_id' => '1',
                 'room_no'=>'200'
            ],
            [
                'unit_id' => '1',
                'room_no'=>'201'
            ],
        );
        foreach ($rooms as $room) {
            Room::create($room);
        }
    }
}
