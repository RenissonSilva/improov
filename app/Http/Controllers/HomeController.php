<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Mission;

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
        }
        return view('home');
    }
}
