<?php

use Illuminate\Database\Seeder;
use App\Mission;

class MissionsTableSeeder extends Seeder
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
                "id" => 1,
                "name" => "Commite em um projeto",
                "level_mission" => 2,
                "points" => 1,
            ],
            [
                "id" => 2,
                "name" => "Realize 2 commits",
                "level_mission" => 3,
                "points" => 2,
            ],
            [
                "id" => 3,
                "name" => "Realize 3 commits",
                "level_mission" => 4,
                "points" => 3,
            ],
            [
                "id" => 4,
                "name" => "Realize 5 commits",
                "level_mission" => 5,
                "points" => 5,
            ],
            [
                "id" => 5,
                "name" => "Realize 20 commits",
                "level_mission" => 6,
                "points" => 20,
            ],
            [
                "id" => 6,
                "name" => "Crie uma missão",
            ],
        ];

        foreach ($items as $item) {
            Mission::updateOrCreate(['id' => $item['id']], $item);
        }
    }
}
