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
            $github_repo = Http::get('https://api.github.com/users/'.$user->nickname.'/repos',[
                'per_page' => 100,
                'sort' => 'updated',
            ]);
            // dd($github_repo);

            $github_repo = json_decode($github_repo);
            $items = [];
            if(isset($github_repo)){

                foreach ($github_repo as $repo) {
                    array_push($items, [
                        'name' => $repo->name,
                        'main_language' => $repo->language,
                        'link' => $repo->html_url,
                        'user_id' => Auth::id(),
                        'updated_at' => Carbon::now(),
                        ]);
                    }

            }
                    foreach ($items as $repo) {
                Repository::updateOrCreate(['link' => $repo['link']], $repo);
            }
        }

        $level = $user->level;

        $github_repo = Repository::where('user_id', Auth::id())->get();

        $last_update = ($github_repo[0]) ? $github_repo[0]->updated_at : 'Ainda não teve atualização';

        return view('list', compact('github_repo', 'level', 'last_update'));
    }

    public function addFavoriteRepository(Request $request) {
        $user = User::where('id', Auth::id())->first();
        $repository = Repository::where('id', $request->id)->first();
        $counting_favorites = Repository::where('user_id', Auth::id())->where('favorite', 1)->count();
        if($counting_favorites < 3 || $request->checked == "false"){
            $repository->favorite = ($repository->favorite == 1) ? 0 : 1;
            $repository->save();
            return response()->json(['status' => 'success', 'checked' => $request->checked]);
        }else{
            return response()->json(['status' => 'error']);
        }
    }
}
