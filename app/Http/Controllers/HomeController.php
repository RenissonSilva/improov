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

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = User::where('id', Auth::id())->first();

        $github_info = Http::get('https://api.github.com/users/'.$user->nickname.'/events/public');
        $github_info = $github_info->json();
        $counter = 0;
        // dd($github_info);
        foreach($github_info as $github_commit){
            if(isset($github_commit['type'])){
                if($github_commit['type'] == 'PushEvent' && Carbon::parse($github_commit['created_at'])->isToday()){
                    $counter++;
                }
            }
        }
        $mission_user = Mission::where('level_mission', $user->level+1)->get();
        $get_missions = $user->mission()->get();
        if($get_missions->isEmpty()){
            foreach($mission_user as $mission){
                $user->mission()->attach($mission);
            }
        }else{
            $github_info = Http::get('https://api.github.com/users/'.$user->nickname.'/events/public');
            $github_info = $github_info->json();
            $counter = 0;

            foreach($github_info as $github_commit){
                if($github_commit['type'] == 'PushEvent' && Carbon::parse($github_commit['created_at'])->isToday()){
                    $counter++;
                }
            }

            $getting_missions = Mission_user::where('user_id', $user->id)->latest()->limit(2)->get();

            $initial_date = Carbon::parse($getting_missions[0]->created_at->format('Y-m-d'));
            $final_date = Carbon::parse(Carbon::now()->format('Y-m-d'));
            $diference = $initial_date->diff($final_date);
            $diference = $diference->format('%d');
            if($diference >= 1){
                $taking_2_missions = Mission::inRandomOrder()->limit(2)->get();

                foreach($taking_2_missions as $mission){
                    $user->mission()->attach($mission);
                }
            }
        }
        $my_missions = [];
        $progress_of_missions = [];

        $missions_id = Mission_user::where('user_id', $user->id)->latest()->limit(2)->get();

        foreach($missions_id as $m){
            $m->mission_user_points = $counter;
            $m->save();
        }

        $missions_id = $missions_id->sortBy('mission_id');

        $loop = 0;

        foreach($missions_id as $mission){
            $m = Mission::where('id', $mission->mission_id)->first();

            $percentage = ($m->points) ? $missions_id[$loop]->mission_user_points / $m->points * 100 : 0;
            if($percentage >= 100){
                if($missions_id[$loop]->added_xp == 0){
                    $missions_id[$loop]->completed = 1;
                    $missions_id[$loop]->save();
                }
            }
            array_push($progress_of_missions, $percentage);
            array_push($my_missions, $m->name);
            $loop++;
        }

        $level = $user->level;

        $total_missions = Mission_user::where('user_id', $user->id)->where('completed', 0)->join('missions', 'mission_id', '=', 'missions.id')->count();
        $completed_missions = count(array_filter($progress_of_missions,function($value){return $value >= 100;}));

        $my_missions = DB::table('missions AS m')
                        ->leftJoin('mission_user AS mu','mu.mission_id','m.id')
                        ->where('m.criador', Auth::id())
                        ->where('m.is_active', 1)
                        ->select('m.id','m.name','m.is_active','m.level_mission','m.points','m.criador',
                                 'm.created_at','m.updated_at','mu.id AS idMissionUser','mu.user_id',
                                 'mu.mission_user_points','mu.completed'
                        )
                        ->get();
        // $following = Http::get('https://api.github.com/users/'.$user->name.'/following');
        // $following = $following->json();
        // dd($following);

        $favorites_repositories = Repository::where('user_id', Auth::id())->where('favorite', 1)->get();

        return view('home', compact('my_missions', 'progress_of_missions', 'completed_missions', 'favorites_repositories', 'total_missions'));
    }

}
