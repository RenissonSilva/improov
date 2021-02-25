<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Response;
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
    public function index(){
        $my_missions = Mission::where('criador', Auth::id())->get();

        return view('mission.index', compact('my_missions'));
    }

    public function store(Request $request){
        $id = Auth::id();

        $addMission = Mission::create(
            ['name' => $request->name, 'criador' => $id]
        );

        if($request->status_mission == 1){
            Mission_user::create(
                ['user_id' => $id, 'mission_id' => $addMission->id]
            );
        }
        $addMission->is_active = $request->status_mission;
        $addMission->save();
        return redirect('user/mission')->with('success','Missão adicionada com Sucesso!');
    }

    public function modalEditMission(Request $request)
    {   
        $mission = Mission::where('id',$request->id)->first();

        return Response::json($mission);
    }

    public function update(Request $request){
        $id = Auth::id();

        $updateMission = DB::table('missions')
                        ->where('id',$request->id_edit)
                        ->update([
                            'name' => $request->name_edit,
                            'is_active' => $request->status_mission,
                            'updated_at' => date('Y-m-d H:i:s')
                        ]);

        if($request->status_mission == 1){
            Mission_user::updateOrCreate(
                ['user_id' => $id, 'mission_id' => $request->id_edit]
            );
        }else{
            Mission_user::where('mission_id', $request->id_edit)->delete();
        }

        return redirect('user/mission')->with('success','Missão atualizada com Sucesso!');
    }

    public function delete($id)
    {
        $mission_user = Mission_user::where('mission_id', $id)->delete();
        $mission = Mission::where('id', $id)->delete();

        return redirect('user/mission')->with('success','Missão deletada com Sucesso!');
    }

    public function modifiedCompletedMission($id){
        $mission = DB::table('mission_user')
                        ->where('id',$id)->first();

        if($mission->completed == 0){
            DB::table('mission_user')->where('id',$id)->update(['completed'=>1,'updated_at' => date('Y-m-d H:i:s')]);
        }else{
            DB::table('mission_user')->where('id',$id)->update(['completed'=>0,'updated_at' => date('Y-m-d H:i:s')]);
        }

        return response()->json('Alterado o status da missão com sucesso!');
    }
}
