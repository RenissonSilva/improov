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
                "xp" => 25,
                "points" => 1,
            ],
            [
                "id" => 2,
                "name" => "Realize 4 commits",
                "xp" => 100,
                "points" => 4,
            ],
        ];

        foreach ($items as $item) {
            Mission::updateOrCreate(['id' => $item['id']], $item);
        }
    }
}
