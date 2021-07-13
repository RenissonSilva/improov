<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Level;
use App\Repository;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use DB;
// use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    public function listRepositories() {
        $github_repo = Repository::where('user_id', Auth::id())->get();
        $last_update = ($github_repo[0]) ? $github_repo[0]->updated_at : 'Ainda não teve atualização';

        return view('list', compact('github_repo', 'last_update'));
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

    public function getPerformance(Request $request) {
        $period = $request->period ?? 36500;
        $json = $request->json ?? false;

        $date = Carbon::today()->subDays($period);

        $user = User::find(Auth::id());
        $countOfRepo = $user->repo()
                        ->whereDate('created_at', '>=', $date)
                        ->count();
                        
        $completedMissions = $user->mission_user()
                        ->where('completed', '1')
                        ->whereDate('created_at', '>=', $date)
                        ->count();

        $main_languages = $user->repo()
                        ->where('main_language', '<>', null)
                        ->whereDate('created_at', '>=', $date)
                        ->select(DB::raw('count(*) as count, main_language'))
                        ->groupBy('main_language')
                        ->orderBy('count', 'DESC')
                        ->get()
                        ->toArray();

        $commits = $user->commits()
                        ->whereDate('created_at', '>=',  $date)
                        ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
                        ->orderBy('date', 'asc')
                        ->groupBy('date')
                        ->get();
        if($json) {
            return response()->json([
                'status' => 'success',
                'countOfRepo' => $countOfRepo,
                'completedMissions' => $completedMissions,
                'main_languages' => $main_languages,
                'commits' => $commits,
            ]);
        }                
        return view('performance', compact('countOfRepo', 'completedMissions', 'main_languages', 'commits'));
    }

    public static function adicionAtualizaRepositoriosUsuario(){
        $verify_update_hour = Repository::where('user_id', Auth::id())->first();

        if($verify_update_hour){
            $isUpdated = Carbon::parse($verify_update_hour->updated_at)->isToday();
        }else{
            $isUpdated = false;
        }

        if(!$isUpdated){
            $github_repo = RequisicaoController::getRepositorios(Auth::user()->nickname);
        
            // Já tenho esse método em LoginController::adicionaAtualizaRepositorios($github_repo);
            $items = [];
            if(isset($repos)){
                foreach ($github_repo as $repo) {
                    $createdAt = Carbon::parse($repo['created_at']);

                    array_push($items, [
                        'name' => $repo['name'],
                        'main_language' => $repo['language'],
                        'link' => $repo['html_url'],
                        'user_id' => Auth::id(),
                        'created_at' => $createdAt->format('Y-m-d H:i:s'),
                    ]);
                }
            }
            
            foreach ($items as $repo) {
                Repository::updateOrCreate(['link' => $repo['link']], $repo);
            }
        }
    }
}
