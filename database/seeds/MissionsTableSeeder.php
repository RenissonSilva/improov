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
                "xp" => "50",
                "points" => 1,
            ],
            [
                "id" => 2,
                "name" => "Realize 4 commits",
                "xp" => "50",
                "points" => 4,
            ],
            [
                "id" => 3,
                "name" => "Realize 2 commits em um desafio",
                "xp" => "50",
                "points" => 2,
            ],
        ];

        foreach ($items as $item) {
            Mission::updateOrCreate(['id' => $item['id']], $item);
        }
    }
}
