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

        // nivel 1 = 6xp
        // nivel 2 = 16xp
        // nivel 3 = 26xp
        // $items = [
            // nivel 1
            DB::table('missions')->insert([
                "id" => 1,
                "name" => "Crie uma missão",
                "level_mission" => 1,
                "points" => 2,
                "is_active" => true
            ]);

            DB::table('missions')->insert([
                "id" => 2,
                "name" => "Modifique a bio do seu github",
                "level_mission" => 1,
                "points" => 5,
                "is_active" => true
            ]);
            // nivel 2
            DB::table('missions')->insert([
                "id" => 3,
                "name" => "Concluir missão criada",
                "level_mission" => 2,
                "points" => 2,
                "is_active" => true
            ]);
            DB::table('missions')->insert([
                "id" => 4,
                "name" => "Crie um repositorio",
                "level_mission" => 2,
                "points" => 5,
                "is_active" => true
            ]);
            DB::table('missions')->insert([
                "id" => 5,
                "name" => "Realize um commit em um repósitorio criado por você",
                "level_mission" => 2,
                "points" => 3,
                "is_active" => true
            ]);
            // nivel 3
            DB::table('missions')->insert([
                "id" => 7,
                "name" => "Crie uma issue",
                "level_mission" => 3,
                "points" => 5,
                "is_active" => true
            ]);
            DB::table('missions')->insert([
                "id" => 8,
                "name" => "Realize 5 commit em um repósitorio criado por você",
                "level_mission" => 3,
                "points" => 5,
                "is_active" => true
            ]);
            // DB::table('missions')->insert([
            //     "id" => 6,
            //     "name" => "Adicione amigo",
            //     "level_mission" => 3,
            //     "points" => 5,
            //     "is_active" => true
            // ]);

        // ];

        // foreach ($items as $item) {
        //     Mission::updateOrCreate(['id' => $item['id']], $item);
        // }
    }
}
