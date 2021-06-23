<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mission_user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SubirLevelController extends Controller
{

    public function verificaSubirLevel(){
        
        // Quantidade de Issues, milestones e de commits feitos!
        $quantIssuesCriadas = 0;
        $quantCommitsFeitos = 0;
        $quantRepos = 0;

        $quantMissoesCriadasCompletas = DB::table('missions AS m')
        ->join('mission_user AS mu','mu.mission_id','m.id')
        ->where('m.criador',Auth::id())
        ->where('mu.completed',1)
        ->count();

        $missoesCriadasPeloUsuario = DB::table('missions')
        ->where('criador',Auth::id())
        ->get();

        SubirLevelController::verificaExperiencia(
                Auth::user(),$c,$quantRepos,
                // $quantFollowers,
                $missoesCriadasPeloUsuario,
                $quantMissoesCriadasCompletas,$quantIssuesCriadas,$quantCommitsFeitos,$bio
            );
        SubirLevelController::verificaUpLevel(Auth::user());
    }

    public static function verificaExperiencia(
        $auth,$quantityCommits,$totalRepositorios,
        // $totalFollowers,
        $missoesCriadasPeloUsuario,$quantMissoesCriadasCompletas,$quantIssuesCriadas,$quantCommitsFeitos,$bio
        )
    {
        if($auth->level == 1){
            if(count($missoesCriadasPeloUsuario) > 0 && $bio != $auth->bio){
                DB::table('users')->where('id',$auth->id)->update(['experiencia'=>$auth->experiencia+6,'updated_at'=>date('Y-m-d H:i:s'),'ultimaAtualizacao'=>date('Y-m-d')]);
                $m1 = DB::table('mission_user')->where('mission_id',1)->where('user_id',$auth->id)->first();
                if($m1->completed == 0){
                    DB::table('mission_user')->where('mission_id',1)->where('user_id',$auth->id)->update(['completed'=>1,'updated_at'=>date('Y-m-d H:i:s')]);
                }
                $m2 = DB::table('mission_user')->where('mission_id',2)->where('user_id',$auth->id)->first();
                if($m2->completed == 0){
                    DB::table('mission_user')->where('mission_id',2)->where('user_id',$auth->id)->update(['completed'=>1,'updated_at'=>date('Y-m-d H:i:s')]);
                }
            }else{
                if(count($missoesCriadasPeloUsuario) > 0){
                    $m1 = DB::table('mission_user')->where('mission_id',1)->where('user_id',$auth->id)->first();
                    if($m1->completed == 0){
                        DB::table('users')->where('id',$auth->id)->update(['experiencia'=>$auth->experiencia+1,'updated_at'=>date('Y-m-d H:i:s'),'ultimaAtualizacao'=>date('Y-m-d')]);
                        DB::table('mission_user')->where('mission_id',1)->where('user_id',$auth->id)->update(['completed'=>1,'updated_at'=>date('Y-m-d H:i:s')]);
                    }
                }
                if($bio != $auth->bio){
                    $m2 = DB::table('mission_user')->where('mission_id',2)->where('user_id',$auth->id)->first();
                    if($m2->completed == 0){
                        DB::table('users')->where('id',$auth->id)->update(['bio'=>$bio,'experiencia'=>$auth->experiencia+5,'ultimaAtualizacao'=>date('Y-m-d'),'updated_at'=>date('Y-m-d H:i:s')]);
                        DB::table('mission_user')->where('mission_id',2)->where('user_id',$auth->id)->update(['completed'=>1,'updated_at'=>date('Y-m-d H:i:s')]);
                    }
                }
            }
        }elseif($auth->level == 2){
            if($quantMissoesCriadasCompletas > 0){
                $m1 = DB::table('mission_user')->where('mission_id',3)->where('user_id',$auth->id)->first();
                if($m1->completed == 0){
                    DB::table('users')->where('id',$auth->id)->update(['experiencia'=>$auth->experiencia+2,'updated_at'=>date('Y-m-d H:i:s'),'ultimaAtualizacao'=>date('Y-m-d')]);
                    DB::table('mission_user')->where('mission_id',3)->where('user_id',$auth->id)->update(['completed'=>1,'updated_at'=>date('Y-m-d H:i:s')]);
                }
            }
            if($totalRepositorios > $auth->totalRepos){
                $m2 = DB::table('mission_user')->where('mission_id',4)->where('user_id',$auth->id)->first();
                if($m2->completed == 0){
                    DB::table('users')->where('id',$auth->id)->update(['totalRepos'=>$totalRepositorios,'ultimaAtualizacao'=>date('Y-m-d'),'experiencia'=>$auth->experiencia+2,'updated_at'=>date('Y-m-d H:i:s')]);
                    DB::table('mission_user')->where('mission_id',4)->where('user_id',$auth->id)->update(['completed'=>1,'updated_at'=>date('Y-m-d H:i:s')]);
                }
            }
            if($quantCommitsFeitos > $auth->TotalCommit){
                $m2 = DB::table('mission_user')->where('mission_id',5)->where('user_id',$auth->id)->first();
                if($m2->completed == 0){
                    DB::table('users')->where('id',$auth->id)->update(['totalCommit'=>$quantCommitsFeitos,'ultimaAtualizacao'=>date('Y-m-d'),'experiencia'=>$auth->experiencia+3,'updated_at'=>date('Y-m-d H:i:s')]);
                    DB::table('mission_user')->where('mission_id',5)->where('user_id',$auth->id)->update(['completed'=>1,'updated_at'=>date('Y-m-d H:i:s')]);
                }
            }
        }elseif($auth->level == 3){
            if($quantIssuesCriadas > $auth->TotalIssue){
                $m1 = DB::table('mission_user')->where('mission_id',7)->where('user_id',$auth->id)->first();
                if($m1->completed == 0){
                    DB::table('users')->where('id',$auth->id)->update(['totalIssue'=>$quantIssuesCriadas,'ultimaAtualizacao'=>date('Y-m-d'),'experiencia'=>$auth->experiencia+3,'updated_at'=>date('Y-m-d H:i:s')]);
                    DB::table('mission_user')->where('mission_id',7)->where('user_id',$auth->id)->update(['completed'=>1,'updated_at'=>date('Y-m-d H:i:s')]);
                }
            }
            if($quantityCommits >= 5){
                $m1 = DB::table('mission_user')->where('mission_id',8)->where('user_id',$auth->id)->first();
                if($m1->completed == 0){
                    DB::table('users')->where('id',$auth->id)->update(['totalCommit'=>$quantCommitsFeitos,'experiencia'=>$auth->experiencia+5,'ultimaAtualizacao'=>date('Y-m-d'),'updated_at'=>date('Y-m-d H:i:s')]);
                    DB::table('mission_user')->where('mission_id',8)->where('user_id',$auth->id)->update(['completed'=>1,'updated_at'=>date('Y-m-d H:i:s')]);
                }
            }
        }elseif($auth->level == 4){
        }elseif($auth->level == 5){
            if($quantityCommits > 20){
                DB::table('users')->where('id',$auth->id)->update(['experiencia'=>$auth->experiencia+5]);
            }
        }
        return Auth::user()->experiencia;
    }

    public static function addMissionWhenUpdateLevel($userId,$level){
        $upLevel = ($level ==1)? $level :$level+1;
        $missoes = DB::table('missions')->where('level_mission',$upLevel)->get();
        foreach($missoes as $m){
            Mission_user::create(
                ['user_id' => $userId, 'mission_id' => $m->id, 'mission_user_points'=>0,'completed'=>0]
            );
        }
    }
    public static function subirLevel($userId,$level){
        $levelUp = (int) $level+1;

        DB::table('users')->where('id',$userId)->update(
            ['dateUplevel'=>date('Y-m-d H:i:s'),'level'=>$levelUp,'updated_at'=>date('Y-m-d H:i:s')]
        );
        SubirLevelController::addMissionWhenUpdateLevel($userId,$level);

        return response()->json('Subiu de level com sucesso!');
    }
    public static function verificaUpLevel($auth){
        $user = DB::table('users')->where('id',$auth->id)->first();
        // dd($user->experiencia);
        if($user->experiencia == 6){
            SubirLevelController::subirLevel($auth->id, $user->level);
        }elseif($user->experiencia == 13){
            SubirLevelController::subirLevel($auth->id, $auth->level);
        }elseif($user->experiencia == 21){
            SubirLevelController::subirLevel($auth->id, $auth->level);
        // }elseif($auth->experiencia == 20){
        //     $this->subirLevel($auth->id, $auth->experiencia);
        // }elseif($auth->level == 35){
        //     $this->subirLevel($auth->id, $auth->experiencia);
        }
    }
}
