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
                "github_id" => "12345",
                "xp" => 90,
                "image" => "https://image.flaticon.com/icons/png/512/147/147144.png"
            ],
        ];

        foreach ($items as $item) {
            User::updateOrCreate($item);
        }
    }
}
