<?php

use Illuminate\Database\Seeder;
use App\Level;

class LevelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            [
                "name" => "1",
            ],
            [
                "name" => "2",
            ],
            [
                "name" => "3",
            ],
            [
                "name" => "4",
            ],
            [
                "name" => "5",
            ],
            [
                "name" => "6",
            ],
            [
                "name" => "7",
            ],
            [
                "name" => "8",
            ],
            [
                "name" => "9",
            ],
            [
                "name" => "10",
            ],
        ];

        foreach ($items as $item) {
            Level::updateOrCreate($item);
        }
    }
}
