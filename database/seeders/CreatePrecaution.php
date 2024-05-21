<?php

namespace Database\Seeders;

use App\Models\PreCaution;
use Illuminate\Database\Seeder;

class CreatePrecaution extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $precautions = array(
            [
                'pre_caution_name' => "HI",
                'abbreviation' => 'HI-Precaution text',
                'color_code' => '#CC99FF',
            ],
            [
                'pre_caution_name' => "SI",
                'abbreviation' => 'SI-Precaution text',
                'color_code' => '#99FFCC',
            ],
            [
                'pre_caution_name' => "MI",
                'abbreviation' => 'MI-Precaution text',
                'color_code' => '#FF0066',
            ],
            [
                'pre_caution_name' => "PI",
                'abbreviation' => 'PI-Precaution text',
                'color_code' => '#0000FF',
            ],
        );
        foreach ($precautions as $precaution) {
            PreCaution::create($precaution);
        }
    }
}
