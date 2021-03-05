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
                "id" => 7,
                "name" => "Crie um repositorio",
                "level_mission" => 1,
                "points" => 2,
                "is_active" => true
            ],
            [
                "id" => 8,
                "name" => "Ganhe um seguidor",
                "level_mission" => 1,
                "points" => 2,
                "is_active" => true
            ],
            [
                "id" => 1,
                "name" => "Commite em um projeto",
                "level_mission" => 1,
                "points" => 1,
                "is_active" => true
            ],
            [
                "id" => 2,
                "name" => "Realize 2 commits",
                "level_mission" => 2,
                "points" => 2,
                "is_active" => true
            ],
            [
                "id" => 3,
                "name" => "Realize 3 commits",
                "level_mission" => 3,
                "points" => 3,
                "is_active" => true
            ],
            [
                "id" => 4,
                "name" => "Realize 5 commits",
                "level_mission" => 4,
                "points" => 5,
                "is_active" => true
            ],
            [
                "id" => 5,
                "name" => "Realize 20 commits",
                "level_mission" => 5,
                "points" => 20,
                "is_active" => true
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
