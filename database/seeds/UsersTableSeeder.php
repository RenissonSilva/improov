<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
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
                "name" => "Usuário padrão",
                "email" => "user@gmail.com",
                "password" => bcrypt('123123'),
                "xp" => 320,
            ],
        ];

        foreach ($items as $item) {
            User::updateOrCreate($item);
        }
    }
}
