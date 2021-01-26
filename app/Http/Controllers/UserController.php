<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
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
        $level = 0;
        $xp = 0;
        $next_level = 0;
        
        $github_repo = json_decode($github_repo);

        return view('list', compact('github_repo', 'level', 'xp', 'next_level'));
    }
}
