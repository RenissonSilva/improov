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
                "name" => "2",
                "required_xp" => 20,
            ],
            [
                "name" => "3",
                "required_xp" => 40,
            ],
            [
                "name" => "4",
                "required_xp" => 60,
            ],
            [
                "name" => "5",
                "required_xp" => 80,
            ],
            [
                "name" => "6",
                "required_xp" => 100,
            ],
            [
                "name" => "7",
                "required_xp" => 120,
            ],
            [
                "name" => "8",
                "required_xp" => 140,
            ],
            [
                "name" => "9",
                "required_xp" => 160,
            ],
            [
                "name" => "10",
                "required_xp" => 180,
            ],
        ];

        foreach ($items as $item) {
            Level::updateOrCreate($item);
        }
    }
}
