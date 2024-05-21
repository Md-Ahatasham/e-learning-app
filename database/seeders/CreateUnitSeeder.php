<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Seeder;

class CreateUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $units = array(
            [
                'name' => 'ICU Unit'
            ],
            [
                'name' => 'Orthopedic Unit'
            ],
        );
        foreach ($units as $unit) {
            Unit::create($unit);
        }
    }
}
