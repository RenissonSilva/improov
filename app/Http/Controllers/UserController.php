<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Level;
use App\Repository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    public function listRepositories() {
        $user = User::where('id', Auth::id())->first();
        $verify_update_hour = Repository::where('user_id', Auth::id())->first();

        if($verify_update_hour){
            $isUpdated = Carbon::parse($verify_update_hour->updated_at)->isToday();
        }else{
            $isUpdated = false;
        }

        if(!$isUpdated){
            $github_repo = Http::get('https://api.github.com/users/'.$user->name.'/repos',[
                'per_page' => 100,
                'sort' => 'updated',
            ]);
            
            $github_repo = json_decode($github_repo);
            $items = [];
            foreach ($github_repo as $repo) {
                array_push($items, [
                    'name' => $repo->name,
                    'main_language' => $repo->language,
                    'link' => $repo->html_url,
                    'user_id' => Auth::id(),
                    'updated_at' => Carbon::now(),
                ]);
            }
    
            foreach ($items as $repo) {
                Repository::updateOrCreate(['link' => $repo['link']], $repo);
            }
        }

        $level = Level::all();

        $xp = $user->xp;
        $i = 0;

        for($i=0; $xp - $level[$i]->required_xp >= 0; $i++){
            $xp -= $level[$i]->required_xp;
        }

        $next_level = $level[$i]->required_xp;
        $level = $level[$i-1]->name;

        $github_repo = Repository::where('user_id', Auth::id())->get();

        $last_update = ($github_repo[0]) ? $github_repo[0]->updated_at : 'Ainda não teve atualização';

        return view('list', compact('github_repo', 'level', 'xp', 'next_level', 'last_update'));
    }
}
