<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\User;
use App\Level;
use App\Mission;
use App\Mission_user;
use App\Repository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
class MissionController extends Controller
{
    public function store(Request $request){
        $addMission = DB::insert(
            'insert into missions (name,criador,created_at) values (?,?,?)',
            [$request->name, Auth::id(), date('Y-m-d H:i:s')]
        );

        $mission = DB::table('missions')->select('criador','id')->where('criador',Auth::id())->orderBy('created_at', 'desc')->first();

        $addMission_user = DB::insert(
            'insert into mission_user (user_id, mission_id,completed,created_at) values (?,?,?)',
            [$mission->criador, $mission->id,0,date('Y-m-d H:i:s')]
        );

        return response()->json('Missão adicionada com Sucesso!');
    }
    public function update(Request $request,$id){
        $updateMission = DB::table('missions')
                        ->where('id',$id)
                        ->update([
                            'name' => $request->name,
                            'updated_at' => date('Y-m-d H:i:s'),
                        ]);

        return response()->json('Missão atualizada com Sucesso!');
    }
    public function modifiedCompletedMission($id){
        $mission = DB::table('mission_user')
                        ->where('id',$id)->first();

        if($mission->completed == 0){
            DB::table('mission_user')->where('id',$id)->update(['completed'=>1]);
        }else{
            DB::table('mission_user')->where('id',$id)->update(['completed'=>0]);
        }

        return response()->json('Alterado o status da missão com sucesso!');
    }
}
