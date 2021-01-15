<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Level;
use App\Mission;
use App\Mission_user;
use Carbon\Carbon;

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
        $mission_user = $user->mission()->get();
        
        if($mission_user->isEmpty()) {
            $taking_2_missions = Mission::inRandomOrder()->limit(2)->get();

            foreach($taking_2_missions as $mission){
                $user->mission()->attach($mission);
            }
        }else{
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
        $missions_id = $missions_id->sortBy('mission_id');

        $loop = 0;

        foreach($missions_id as $mission){
            $m = Mission::where('id', $mission->mission_id)->first();
            $percentage = $missions_id[$loop]->mission_user_points / $m->points * 100;
            array_push($progress_of_missions, $percentage);
            array_push($my_missions, $m->name);
            $loop++;
        }
        $level = Level::all();

        $xp = $user->xp;
        $i = 0;

        for($i=0; $xp - $level[$i]->required_xp >= 0; $i++){
            $xp -= $level[$i]->required_xp;
        }

        $next_level = $level[$i]->required_xp;
        $level = $level[$i-1]->name;

        $completed_missions = count(array_filter($progress_of_missions,function($value){return $value >= 100;}));

        return view('home', compact('my_missions', 'level', 'xp', 'next_level', 'progress_of_missions', 'completed_missions'));
    }
}
