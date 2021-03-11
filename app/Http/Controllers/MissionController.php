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
use DateTime;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class MissionController extends Controller
{
    public function index(){

//         $following = Http::get('https://api.github.com/users/'.Auth::user()->nickname.'/repos');
//         $following = $following->json();
//         $quantRepos = 0;


//         $bio = Http::get('https://api.github.com/users/'.Auth::user()->nickname)->json();
//         $bio = $bio->bio;
// dd($bio);
//         // Pegando o nome de uma linguagem que não fez o projeto principal
//         foreach($following as $f){
//             $languages[] = $f['language'];
//             $languages = array_unique($languages);
//         }
//         $linguagensFaltam = $this->LanguagesQueFaltam($languages);
//         $indiceAleatorio= array_rand($linguagensFaltam,1);
//         $linguagemAleato = $linguagensFaltam[$indiceAleatorio];

//         $repos = Http::get('https://api.github.com/users/ericksonferreira/repos')->json();
//         $quantCommitsFeitos = 0;
//         foreach($repos as $r){
//             // $quantIssuesCriadas+= $r['contributors'];
//             // $r['contributors_url'];
//             // dd($r);
//             $contribuidores = Http::get($r['contributors_url'])->json();
//             foreach($contribuidores as $c){
//                 if($c['login'] == Auth::user()->nickname){
//                     // dd($c);
//                     $quantCommitsFeitos += $c['contributions'];
//                 }
//             }
//         }
//         dd($quantCommitsFeitos);
//         // dd($quantIssuesCriadas);

        $my_missions = DB::table('missions AS m')
                        ->leftJoin('mission_user AS mu','mu.mission_id','m.id')
                        ->where([
                            ['m.level_mission', '=',Auth::user()->level],
                            ['mu.completed', '=',0]
                        ])
                        ->orwhere('m.criador', Auth::id())
                        ->select('m.id','m.name','m.is_active','m.level_mission','m.points','m.criador',
                                 'm.created_at','m.updated_at','mu.id AS idMissionUser','mu.user_id',
                                 'mu.mission_user_points','mu.completed'
                        )
                        ->get();
                        // dd($my_missions);
        return view('mission.index', compact('my_missions'));
    }

    // Método de uma função que será implementada futuramente
    // Que verifica quais linguagens o usuario não utiliza e pede escolhe uma aleatoria
    public function LanguagesQueFaltam($languages){
        $todasLanguages = [
            'PHP',
            'JAVA',
            'Go',
            'Swift',
            'Kotlin',
            'Python',
            'JavaScript',
            'C#',
            'C++',
            'C'
        ];

        for($i=0;$i<count($languages);$i++){
            if($languages[$i] == 'PHP'){
                unset($todasLanguages[$i]);
            }elseif($languages[$i] == 'JAVA'){
                unset($todasLanguages[$i]);
            }elseif($languages[$i] == 'JavaScript'){
                unset($todasLanguages[$i]);
            }elseif($languages[$i] == 'Python'){
                unset($todasLanguages[$i]);
            }elseif($languages[$i] == 'C++'){
                unset($todasLanguages[$i]);
            }elseif($languages[$i] == 'Swift'){
                unset($todasLanguages[$i]);
            }elseif($languages[$i] == 'Go'){
                unset($todasLanguages[$i]);
            }elseif($languages[$i] == 'Kotlin'){
                unset($todasLanguages[$i]);
            }elseif($languages[$i] == 'C#'){
                unset($todasLanguages[$i]);
            }elseif($languages[$i] == 'C'){
                unset($todasLanguages[$i]);
            }
        }
        return $todasLanguages;
    }

    public function store(Request $request){
        $id = Auth::id();

        $addMission = Mission::create(
            ['name' => $request->name, 'criador' => $id]
        );
        $missaoCriada = DB::table('missions')->where('criador',$id)->orderBy('id','desc')->first();
        $addUserMission = Mission_user::create(
            ['user_id' => $id, 'mission_id' => $missaoCriada->id,'mission_user_points'=>0,'completed'=>0]
        );
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
                            'repeat_mission' => $request->repeat_mission ?? 0,
                            'updated_at' => date('Y-m-d H:i:s')
                        ]);

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

    public function changeStatusMission(Request $request)
    {
        $mission = Mission::where('id', $request->id)->first();

        if($request->is_active == "true"){
            $mission->is_active = 1;
            $mission->save();
        }else{
            $mission->is_active = 0;
            $mission->save();
        }

        return response()->json('Missão atualizada com Sucesso');
    }

    public function modifiedCompletedMission(Request $request){
        $id = $request->id;

        $mission_user = Mission_user::where('mission_id',(int) $id)->first();
        // return response()->json($mission_user);
        if($mission_user->completed == 0){
            $mission_user->completed=1;
            $mission_user->updated_at = date('Y-m-d H:i:s');
            $mission_user->save();
        }else{
            $mission_user->completed=0;
            $mission_user->updated_at = date('Y-m-d H:i:s');
            $mission_user->save();
        }

        // return response()->json($mission_user);
        return response()->json($mission_user->mission_id);
    }

    public function teste(Request $request){
        $this->subirLevel(Auth::id(), Auth::user()->level);
    }













}
