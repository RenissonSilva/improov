<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Level;
use App\Repository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    public function listRepositories() {
        $user = User::where('id', Auth::id())->first();
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
            ]);
        }

        foreach ($items as $repo) {
            Repository::updateOrCreate(['link' => $repo['link']], $repo);
        }

        $level = Level::all();

        $xp = $user->xp;
        $i = 0;

        for($i=0; $xp - $level[$i]->required_xp >= 0; $i++){
            $xp -= $level[$i]->required_xp;
        }

        $next_level = $level[$i]->required_xp;
        $level = $level[$i-1]->name;

        return view('list', compact('github_repo', 'level', 'xp', 'next_level'));
    }
}
