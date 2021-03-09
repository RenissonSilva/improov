<?php

namespace App\Console\Commands;

use App\Mission;
use App\Mission_user;
use Illuminate\Console\Command;

class ChangeMissionStatusCron extends Command
{
    protected $signature = 'changestatus';

    protected $description = 'Ativa missões programadas pelos usuários';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $missions = Mission::where('repeat_mission', '!=', 0)->get();
        foreach($missions as $mission){
            Mission_user::updateOrCreate(
                [
                    'user_id' => $mission->criador,
                    'mission_id' => $mission->id,
                ]
            );
        }

        $this->info('Cron para ativar missões executada com sucesso');
    }
}
