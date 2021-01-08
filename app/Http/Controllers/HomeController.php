<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
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
        $missions = Mission::all();
        $mission_user = $user->mission()->get();
        
        if($mission_user->isEmpty()) {
            $taking_2_missions = Mission::inRandomOrder()->limit(2)->get();

            foreach($taking_2_missions as $mission){
                $user->mission()->attach($mission);
            }
        }else{
            $getting_missions = Mission_user::where('user_id', $user->id)->latest()->limit(2)->get();

            $data_inicial = Carbon::parse($getting_missions[0]->created_at->format('Y-m-d'));
            $data_final = Carbon::parse(Carbon::now()->format('Y-m-d'));
            $diferenca = $data_inicial->diff($data_final); 
            $diferenca = $diferenca->format('%d');
            if($diferenca >= 1){
                $taking_2_missions = Mission::inRandomOrder()->limit(2)->get();

                foreach($taking_2_missions as $mission){
                    $user->mission()->attach($mission);
                }
            }
        }
        return view('home');
    }
}
