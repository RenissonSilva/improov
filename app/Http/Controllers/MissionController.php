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
        $my_missions = DB::table('missions AS m')
                        ->leftJoin('mission_user AS mu','mu.mission_id','m.id')
                        ->where('m.level_mission', Auth::user()->level)
                        ->orwhere('m.criador', Auth::id())
                        ->select('m.id','m.name','m.is_active','m.level_mission','m.points','m.criador',
                                 'm.created_at','m.updated_at','mu.id AS idMissionUser','mu.user_id',
                                 'mu.mission_user_points','mu.completed'
                        )
                        ->get();

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
        $addMission->is_active = $request->status_mission ?? 0;
        $addMission->repeat_mission = $request->repeat_mission ?? 0;
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
                            'is_active' => $request->status_mission ?? 0,
                            'repeat_mission' => $request->repeat_mission ?? 0,
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
        // $mission_user = Mission_user::where('id', $id);
        // $muFirst = $mission_user->first();
        // $mission_user->delete();

        // $mission = Mission::where('id', $muFirst->mission_id)->first();
        // if($mission->criador != null){
        //     Mission::where('id', $muFirst->mission_id)->delete();
        // }
        $mission_user = Mission_user::where('mission_id', $id)->delete();
        $mission = Mission::where('id', $id)->delete();
        
        return redirect('user/mission')->with('success','Missão deletada com Sucesso!');
    }

    public function modifiedCompletedMission(Request $request){
        $id = $request->id;
        $mission_user = DB::table('mission_user')->where('id',$id);
        $mission = $mission_user->first();

        if($mission->completed == 0){
            $mission_user->update(['completed'=>1,'updated_at' => date('Y-m-d H:i:s')]);
        }else{
            $mission_user->update(['completed'=>0,'updated_at' => date('Y-m-d H:i:s')]);
        }

        return response()->json('Alterado o status da missão com sucesso!');
    }

    public function teste(Request $request){
        $this->subirLevel(Auth::id(), Auth::user()->level);
    }

    private function subirLevel($userId,$level){
        $levelUp = (int) $level+1;
        DB::table('users')->where('id',$userId)->update(['level'=>$levelUp]);
        $this->addMissionWhenUpdateLevel($userId,$levelUp);

        return response()->json('Subiu de level com sucesso!');
    }
    private function addMissionWhenUpdateLevel($userId,$level){
        $missoes = DB::table('missions')->where('level_mission',$level)->get();
        foreach($missoes as $m){
            Mission_user::create(
                ['user_id' => $userId, 'mission_id' => $m->id, 'mission_user_points'=>0,'completed'=>0]
            );
        }

    }
}
