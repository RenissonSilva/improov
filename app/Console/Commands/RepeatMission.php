<?php

namespace App\Console\Commands;

use App\User;
use App\Mission;
use App\Mission_user;
use Illuminate\Console\Command;

class RepeatMission extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mission:repeat';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Ativa missões que usuário definiu como repetitíveis';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = User::with('mission')->whereHas('mission', function ($query) {
            return $query->where('repeat_mission', '=', 1)->where('is_active', '=', 0);
        })->get();

        foreach($users as $user) {
            foreach($user->mission as $m){
                if($m->repeat_mission === 1 && $m->is_active === 0){
                    $m->is_active = 1;
                    $m->save();
                }
            }
        };
    }
}
