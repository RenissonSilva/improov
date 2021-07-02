<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\SubirLevelController;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AcaoController extends Controller
{
    public function atualizaRepositorios(){
        $users = DB::table('users')->select('nickname')->get();
        foreach($users as $user){
            $repos = RequisicaoController::getRepositorios($user->nickname);
            LoginController::adicionaAtualizaRepositorios($repos);
        }
        return "Repositorios atualizados com sucesso!";
    }
    public function atualizaSubirNivel(){
        $users = DB::table('users')->get();
        foreach($users as $user){
            $repos = RequisicaoController::acoesUser($user->nickname);
            $userBio = RequisicaoController::usuario($user->nickname);
            $this->verificaSubirLevel($user,$repos,$userBio['bio']);
        }
        return "Atualização de níveis com sucesso!";
    }

    public function verificaSubirLevel($user,$repos,$bio){
        $c=0;
        $dateLevel = Carbon::parse($user->dateUpLevel)->valueOf();

        foreach($repos as $r){
            $created = Carbon::parse($r['created_at'])->valueOf();
            if($dateLevel < $created){
                $c++;
            }
        }

        // Quantidade de Issues, milestones e de commits feitos!
        $quantIssuesCriadas = 0;
        $quantCommitsFeitos = 0;
        $quantRepos = 0;

        $quantMissoesCriadasCompletas = DB::table('missions AS m')
        ->join('mission_user AS mu','mu.mission_id','m.id')
        ->where('m.criador',$user->id)
        ->where('mu.completed',1)
        ->count();

        $missoesCriadasPeloUsuario = DB::table('missions')
        ->where('criador',$user->id)
        ->get();

        SubirLevelController::verificaExperiencia(
                $user,$c,$quantRepos,
                // $quantFollowers,
                $missoesCriadasPeloUsuario,
                $quantMissoesCriadasCompletas,$quantIssuesCriadas,$quantCommitsFeitos,$bio
            );
        SubirLevelController::verificaUpLevel($user);
    }

}
