<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mission_user;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;
use DB;
use Auth;
use App\User;
use Carbon\Carbon;
use DateTime;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/user/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToProvider()
    {
        return Socialite::driver('github')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        try {
            $user_github = Socialite::driver('github')->user();
        } catch (Exception $e) {
            return redirect('/error');
        }
        // dd(session()->get('user.repos'));
        $name = $user_github->getName() ?? $user_github->getNickname();
        $nickname = $user_github->getNickname();
        $email = $user_github->getEmail();
        $github_id = $user_github->getId();
        $image = $user_github->getAvatar();
        $bio = $user_github->user['bio'];
        $search_user = User::where('email', $email)->first();

        // Verifica a quantidade de repositorios
        $repos = Http::get('https://api.github.com/users/'.$nickname.'/repos')->json();

        // Quantidade de Issues, milestones e de commits feitos!
        $quantIssuesCriadas = 0;
        $quantCommitsFeitos = 0;
        $quantRepos = 0;

        // Filtrando pelos ultimos repositorios modificados
        $jsonString = json_encode($repos);
        $b = json_decode($jsonString);
        $collection = collect($b);
        $sorted = $collection->sortBy('updated_at');

        // Codigo que possivelmete será reaaprovietado
        // foreach($repos as $r){

        //     // quantidadede Issues criadas
        //     // $e = explode('/', $r['full_name']);
        //     // if($e[0] == $nickname){
        //     //     $i[] = $e[1];
        //     //     $quantRepos++;
        //     // }
        //     // $quantIssuesCriadas+= $r['open_issues_count'];

        //     $contribuidores = Http::get($r['contributors_url'])->json();
        //     foreach($contribuidores as $c){
        //         if($c['login'] == $nickname){
        //             $quantCommitsFeitos += $c['contributions'];
        //         }
        //     }
        // }

        // Quantidade de seguidores
        // $followers = Http::get('https://api.github.com/users/'.$nickname.'/followers')->json();
        // $quantFollowers = count($followers);

        if($search_user){

            Auth::loginUsingId($search_user->id);

            // $github_info = Http::get('https://api.github.com/users/'.$nickname.'/events/public')->json();
            // session()->put('github_info',$github_info);
            // // $repos->count();
            // // dd($github_info->json());
            // $dateLevel = Carbon::parse(Auth::user()->dateUpLevel)->valueOf();

            // foreach($github_info as $git){

            //     $created_at[] = Carbon::parse($git['created_at'])->valueOf();
            // }
            // $c=0;
            // foreach($created_at as $created){

            //     if($dateLevel < $created){
            //         $c++;
            //     }
            // }


            $dataHoje = new DateTime(date('Y-m-d'));
            if(new Datetime(Auth::user()->ultimaAtualizacao) < $dataHoje){
                // Verifica os ultimos commits feitos
                try{
                    foreach( $sorted as $s){
                        if(new DateTime($s->updated_at) >= new DateTime(Auth::user()->ultimaAtualizacao)){
                            $contribuidores = Http::get($s->contributors_url)->json();
                            if($contribuidores != null){
                                foreach($contribuidores as $c){
                                    if($c['login'] == $nickname){
                                        $quantCommitsFeitos += $c['contributions'];
                                    }
                                }
                            }
                        }
                    }
                }catch (Exception $e) {
                    return redirect('/error');
                }

                $quantMissoesCriadasCompletas = DB::table('missions AS m')
                ->join('mission_user AS mu','mu.mission_id','m.id')
                ->where('m.criador',Auth::id())
                ->where('mu.completed',1)
                ->count();

                $missoesCriadasPeloUsuario = DB::table('missions')
                ->where('criador',Auth::id())
                ->get();

                $this->verificaExperiencia(
                        Auth::user(),$c,$quantRepos,
                        // $quantFollowers,
                        $missoesCriadasPeloUsuario,
                        $quantMissoesCriadasCompletas,$quantIssuesCriadas,$quantCommitsFeitos,$bio
                    );
                $this->verificaUpLevel(Auth::user());
            }

        }else{
            //  Adiciona a quantidae commits feitos
            try{
                foreach($repos as $r){
                    $contribuidores = Http::get($r['contributors_url'])->json();
                    if (is_array($contribuidores) || is_object($contribuidores)){
                        foreach($contribuidores as $c){
                            if($c['login'] == $nickname){
                                $quantCommitsFeitos += $c['contributions'];
                            }
                        }
                    }
                }
            }catch (Exception $e) {
                return redirect('/error');

            }

            $data = [
                'name' => $name,
                'nickname' => $nickname,
                'email' => $email ,
                'github_id' => $github_id,
                'image' => $image,
                'experiencia' => 0,
                'dateUpLevel' => date('Y-m-d H:i:s'),
                'ultimaAtualizacao' => date('Y-m-d H:i:s'),
                'totalRepos' => $quantRepos,
                'totalIssue' => $quantIssuesCriadas,
                'totalCommit' => $quantCommitsFeitos,
                // 'totalMilestone' => $quantMilestonesCriadas,
                // 'quantSeguidores' => $quantFollowers,
                'bio' => $bio
            ];


            $user = User::create($data);

            $token = Str::random(64);

            DB::table('password_resets')->insert([
                'email' => $email,
                'token' => bcrypt($token),
            ]);

            Auth::loginUsingId($user->id);

            // Adicionando missões aos usuários
            $mission_user1 = new Mission_user();
            $mission_user1->user_id = (int) Auth::id();
            $mission_user1->mission_id = 1;
            $mission_user1->completed = 0;
            $mission_user1->mission_user_points=0;
            $mission_user1->save();

            $mission_user2 = new Mission_user();
            $mission_user2->user_id = (int) Auth::id();
            $mission_user2->mission_id = 2;
            $mission_user2->completed = 0;
            $mission_user2->mission_user_points=0;
            $mission_user2->save();

            // Mission_user::create([
            //     'user_id' => (int) Auth::id(),
            //     'mission_id' => 2,
            //     'completed' => 0,
            //     'mission_user_points'=>0,
            //     'created_at' => date('Y-m-d H:i:s')
            // ]);

        }
        return redirect('/user/home');
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    private function subirLevel($userId,$level){
        $levelUp = (int) $level+1;

        DB::table('users')->where('id',$userId)->update(
            ['dateUplevel'=>date('Y-m-d H:i:s'),'level'=>$levelUp,'updated_at'=>date('Y-m-d H:i:s')]
        );
        $this->addMissionWhenUpdateLevel($userId,$level);

        return response()->json('Subiu de level com sucesso!');
    }
    private function addMissionWhenUpdateLevel($userId,$level){
        $upLevel = ($level ==1)? $level :$level+1;
        $missoes = DB::table('missions')->where('level_mission',$upLevel)->get();
        foreach($missoes as $m){
            Mission_user::create(
                ['user_id' => $userId, 'mission_id' => $m->id, 'mission_user_points'=>0,'completed'=>0]
            );
        }
    }
    private function verificaExperiencia(
        $auth,$quantityCommits,$totalRepositorios,
        // $totalFollowers,
        $missoesCriadasPeloUsuario,$quantMissoesCriadasCompletas,$quantIssuesCriadas,$quantCommitsFeitos,$bio
        )
    {
        if($auth->level == 1){
            if(count($missoesCriadasPeloUsuario) > 0 && $bio != $auth->bio){
                DB::table('users')->where('id',$auth->id)->update(['experiencia'=>$auth->experiencia+6,'updated_at'=>date('Y-m-d H:i:s'),'ultimaAtualizacao'=>date('Y-m-d')]);
                $m1 = DB::table('mission_user')->where('mission_id',1)->where('user_id',$auth->id)->first();
                if($m1->completed == 0){
                    DB::table('mission_user')->where('mission_id',1)->where('user_id',$auth->id)->update(['completed'=>1,'updated_at'=>date('Y-m-d H:i:s')]);
                }
                $m2 = DB::table('mission_user')->where('mission_id',2)->where('user_id',$auth->id)->first();
                if($m2->completed == 0){
                    DB::table('mission_user')->where('mission_id',2)->where('user_id',$auth->id)->update(['completed'=>1,'updated_at'=>date('Y-m-d H:i:s')]);
                }
            }else{
                if(count($missoesCriadasPeloUsuario) > 0){
                    $m1 = DB::table('mission_user')->where('mission_id',1)->where('user_id',$auth->id)->first();
                    if($m1->completed == 0){
                        DB::table('users')->where('id',$auth->id)->update(['experiencia'=>$auth->experiencia+1,'updated_at'=>date('Y-m-d H:i:s'),'ultimaAtualizacao'=>date('Y-m-d')]);
                        DB::table('mission_user')->where('mission_id',1)->where('user_id',$auth->id)->update(['completed'=>1,'updated_at'=>date('Y-m-d H:i:s')]);
                    }
                }
                if($bio != $auth->bio){
                    $m2 = DB::table('mission_user')->where('mission_id',2)->where('user_id',$auth->id)->first();
                    if($m2->completed == 0){
                        DB::table('users')->where('id',$auth->id)->update(['bio'=>$bio,'experiencia'=>$auth->experiencia+5,'ultimaAtualizacao'=>date('Y-m-d'),'updated_at'=>date('Y-m-d H:i:s')]);
                        DB::table('mission_user')->where('mission_id',2)->where('user_id',$auth->id)->update(['completed'=>1,'updated_at'=>date('Y-m-d H:i:s')]);
                    }
                }
            }
        }elseif($auth->level == 2){
            if($quantMissoesCriadasCompletas > 0){
                $m1 = DB::table('mission_user')->where('mission_id',3)->where('user_id',$auth->id)->first();
                if($m1->completed == 0){
                    DB::table('users')->where('id',$auth->id)->update(['experiencia'=>$auth->experiencia+2,'updated_at'=>date('Y-m-d H:i:s'),'ultimaAtualizacao'=>date('Y-m-d')]);
                    DB::table('mission_user')->where('mission_id',3)->where('user_id',$auth->id)->update(['completed'=>1,'updated_at'=>date('Y-m-d H:i:s')]);
                }
            }
            if($totalRepositorios > $auth->totalRepos){
                $m2 = DB::table('mission_user')->where('mission_id',4)->where('user_id',$auth->id)->first();
                if($m2->completed == 0){
                    DB::table('users')->where('id',$auth->id)->update(['totalRepos'=>$totalRepositorios,'ultimaAtualizacao'=>date('Y-m-d'),'experiencia'=>$auth->experiencia+2,'updated_at'=>date('Y-m-d H:i:s')]);
                    DB::table('mission_user')->where('mission_id',4)->where('user_id',$auth->id)->update(['completed'=>1,'updated_at'=>date('Y-m-d H:i:s')]);
                }
            }
            if($quantCommitsFeitos > $auth->TotalCommit){
                $m2 = DB::table('mission_user')->where('mission_id',5)->where('user_id',$auth->id)->first();
                if($m2->completed == 0){
                    DB::table('users')->where('id',$auth->id)->update(['totalCommit'=>$quantCommitsFeitos,'ultimaAtualizacao'=>date('Y-m-d'),'experiencia'=>$auth->experiencia+3,'updated_at'=>date('Y-m-d H:i:s')]);
                    DB::table('mission_user')->where('mission_id',5)->where('user_id',$auth->id)->update(['completed'=>1,'updated_at'=>date('Y-m-d H:i:s')]);
                }
            }
        }elseif($auth->level == 3){
            if($quantIssuesCriadas > $auth->TotalIssue){
                $m1 = DB::table('mission_user')->where('mission_id',7)->where('user_id',$auth->id)->first();
                if($m1->completed == 0){
                    DB::table('users')->where('id',$auth->id)->update(['totalIssue'=>$quantIssuesCriadas,'ultimaAtualizacao'=>date('Y-m-d'),'experiencia'=>$auth->experiencia+3,'updated_at'=>date('Y-m-d H:i:s')]);
                    DB::table('mission_user')->where('mission_id',7)->where('user_id',$auth->id)->update(['completed'=>1,'updated_at'=>date('Y-m-d H:i:s')]);
                }
            }
            if($quantityCommits >= 5){
                $m1 = DB::table('mission_user')->where('mission_id',8)->where('user_id',$auth->id)->first();
                if($m1->completed == 0){
                    DB::table('users')->where('id',$auth->id)->update(['totalCommit'=>$quantCommitsFeitos,'experiencia'=>$auth->experiencia+5,'ultimaAtualizacao'=>date('Y-m-d'),'updated_at'=>date('Y-m-d H:i:s')]);
                    DB::table('mission_user')->where('mission_id',8)->where('user_id',$auth->id)->update(['completed'=>1,'updated_at'=>date('Y-m-d H:i:s')]);
                }
            }
        }elseif($auth->level == 4){
        }elseif($auth->level == 5){
            if($quantityCommits > 20){
                DB::table('users')->where('id',$auth->id)->update(['experiencia'=>$auth->experiencia+5]);
            }
        }
        return Auth::user()->experiencia;
    }
    private function verificaUpLevel($auth){
        $user = DB::table('users')->where('id',$auth->id)->first();
        // dd($user->experiencia);
        if($user->experiencia == 6){
            $this->subirLevel($auth->id, $user->level);
        }elseif($user->experiencia == 13){
            $this->subirLevel($auth->id, $auth->level);
        }elseif($user->experiencia == 21){
            $this->subirLevel($auth->id, $auth->level);
        // }elseif($auth->experiencia == 20){
        //     $this->subirLevel($auth->id, $auth->experiencia);
        // }elseif($auth->level == 35){
        //     $this->subirLevel($auth->id, $auth->experiencia);
        }
    }
}
