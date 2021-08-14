<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\RequisicaoController;
use App\Mission_user;
use App\Providers\RouteServiceProvider;
use App\Repository;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;
use DB;
use Auth;
use App\User;
use App\Commit;
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
        // dd();
        try{
            $user_github = RequisicaoController::getUser();
            // dd(session()->get('user.repos'));
            $name = $user_github->getName() ?? $user_github->getNickname();
            $nickname = $user_github->getNickname();
            $email = $user_github->getEmail();
            $github_id = $user_github->getId();
            $image = $user_github->getAvatar();
            $bio = $user_github->user['bio'];
            $user = User::where('email', $email)->first();
        }catch (Exception $e    ){
            return redirect('/error');
        }
        $bio = $user_github->user['bio'];
        $search_user = User::where('email', $email)->first();
        $usuarioJaFoiCadastrado = (count(DB::table('users')->where('nickname',$nickname)->get())) > 0? true : false;
        if($usuarioJaFoiCadastrado){
            // dd();
            Auth::loginUsingId($user->id);

            $countOfRepo = $user->repo()->count();
            $completedMissions = $user->mission()->where('completed', '1')->count();
            $focus = 0;
            $missions = $user->mission_user()->orderBy('updated_at', 'DESC')->get();

            return redirect()->route('home');
        }else{
            $this->cadastraUsuario($name,$nickname,$email,$github_id,$image,$bio);
            return redirect()->route('home');
        }


        // // pega repositorio e filtra ele pelos ultimos modificados

        // // Verifica a quantidade de repositorios
        // $repos = RequisicaoController::getRepositorios($nickname);

        // // Quantidade de Issues, milestones e de commits feitos!
        // $quantIssuesCriadas = 0;
        // $quantCommitsFeitos = 0;
        // $quantRepos = 0;

        // // Filtrando pelos ultimos repositorios modificados
        // $jsonString = json_encode($repos);
        // $b = json_decode($jsonString);
        // $collection = collect($b);
        // $sorted = $collection->sortBy('updated_at');

        // // Codigo que possivelmete será reaaprovietado
        // // foreach($repos as $r){

        // //     // quantidadede Issues criadas
        // //     // $e = explode('/', $r['full_name']);
        // //     // if($e[0] == $nickname){
        // //     //     $i[] = $e[1];
        // //     //     $quantRepos++;
        // //     // }
        // //     // $quantIssuesCriadas+= $r['open_issues_count'];

        // //     $contribuidores = Http::get($r['contributors_url'])->json();
        // //     foreach($contribuidores as $c){
        // //         if($c['login'] == $nickname){
        // //             $quantCommitsFeitos += $c['contributions'];
        // //         }
        // //     }
        // // }

        // // Quantidade de seguidores
        // // $followers = Http::get('https://api.github.com/users/'.$nickname.'/followers')->json();
        // // $quantFollowers = count($followers);

        // if($user){

        //     Auth::loginUsingId($user->id);

        //     // $github_info = Http::get('https://api.github.com/users/'.$nickname.'/events/public')->json();
        //     // session()->put('github_info',$github_info);
        //     // // $repos->count();
        //     // // dd($github_info->json());
        //     // $dateLevel = Carbon::parse(Auth::user()->dateUpLevel)->valueOf();

        //     // foreach($github_info as $git){

        //     //     $created_at[] = Carbon::parse($git['created_at'])->valueOf();
        //     // }
        //     // $c=0;
        //     // foreach($created_at as $created){

        //     //     if($dateLevel < $created){
        //     //         $c++;
        //     //     }
        //     // }


        //     $dataHoje = new DateTime(date('Y-m-d'));
        //     if(new Datetime(Auth::user()->ultimaAtualizacao) < $dataHoje){
        //         // Verifica os ultimos commits feitos

        //         RequisicaoController::AtualizaQuantCommitsFeitos($sorted, Auth::user(), $nickname,$quantCommitsFeitos);
        //         // try{
        //         //     foreach( $sorted as $s){
        //         //         if(new DateTime($s->updated_at) >= new DateTime(Auth::user()->ultimaAtualizacao)){
        //         //             $contribuidores = Http::get($s->contributors_url)->json();
        //         //             if($contribuidores != null){
        //         //                 foreach($contribuidores as $c){
        //         //                     if($c['login'] == $nickname){
        //         //                         $quantCommitsFeitos += $c['contributions'];
        //         //                     }
        //         //                 }
        //         //             }
        //         //         }
        //         //     }
        //         // }catch (Exception $e) {
        //         //     return redirect('/error');
        //         // }

        //         $quantMissoesCriadasCompletas = DB::table('missions AS m')
        //         ->join('mission_user AS mu','mu.mission_id','m.id')
        //         ->where('m.criador',Auth::id())
        //         ->where('mu.completed',1)
        //         ->count();

        //         $missoesCriadasPeloUsuario = DB::table('missions')
        //         ->where('criador',Auth::id())
        //         ->get();

        //         SubirLevelController::verificaExperiencia(
        //                 Auth::user(),$c,$quantRepos,
        //                 // $quantFollowers,
        //                 $missoesCriadasPeloUsuario,
        //                 $quantMissoesCriadasCompletas,$quantIssuesCriadas,$quantCommitsFeitos,$bio
        //             );
        //         SubirLevelController::verificaUpLevel(Auth::user());
        //     }

        // }else{
        //     RequisicaoController::AdicionaQuantCommitsFeitos($repos, $nickname,$quantCommitsFeitos);

        //     //  Adiciona a quantidae commits feitos
        //     // try{
        //     //     foreach($repos as $r){
        //     //         $contribuidores = Http::get($r['contributors_url'])->json();
        //     //         if (is_array($contribuidores) || is_object($contribuidores)){
        //     //             foreach($contribuidores as $c){
        //     //                 if($c['login'] == $nickname){
        //     //                     $quantCommitsFeitos += $c['contributions'];
        //     //                 }
        //     //             }
        //     //         }
        //     //     }
        //     // }catch (Exception $e) {
        //     //     return redirect('/error');

        //     // }

        //     $data = [
        //         'name' => $name,
        //         'nickname' => $nickname,
        //         'email' => $email ,
        //         'github_id' => $github_id,
        //         'image' => $image,
        //         'experiencia' => 0,
        //         'dateUpLevel' => date('Y-m-d H:i:s'),
        //         'ultimaAtualizacao' => date('Y-m-d H:i:s'),
        //         'totalRepos' => $quantRepos,
        //         'totalIssue' => $quantIssuesCriadas,
        //         'totalCommit' => $quantCommitsFeitos,
        //         // 'totalMilestone' => $quantMilestonesCriadas,
        //         // 'quantSeguidores' => $quantFollowers,
        //         'bio' => $bio
        //     ];


        //     $user = User::create($data);

        //     $token = Str::random(64);

        //     DB::table('password_resets')->insert([
        //         'email' => $email,
        //         'token' => bcrypt($token),
        //     ]);

        //     Auth::loginUsingId($user->id);

        //     // Adicionando missões aos usuários
        //     $mission_user1 = new Mission_user();
        //     $mission_user1->user_id = (int) Auth::id();
        //     $mission_user1->mission_id = 1;
        //     $mission_user1->completed = 0;
        //     $mission_user1->mission_user_points=0;
        //     $mission_user1->save();

        //     $mission_user2 = new Mission_user();
        //     $mission_user2->user_id = (int) Auth::id();
        //     $mission_user2->mission_id = 2;
        //     $mission_user2->completed = 0;
        //     $mission_user2->mission_user_points=0;
        //     $mission_user2->save();

        //     // Mission_user::create([
        //     //     'user_id' => (int) Auth::id(),
        //     //     'mission_id' => 2,
        //     //     'completed' => 0,
        //     //     'mission_user_points'=>0,
        //     //     'created_at' => date('Y-m-d H:i:s')
        //     // ]);

        // }
        // return redirect('/user/home');
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    private function cadastraUsuario($name,$nickname,$email,$github_id,$image,$bio){
         // Verifica a quantidade de repositorios
         $repos = RequisicaoController::getRepositorios($nickname);

         // Quantidade de Issues, milestones e de commits feitos!
         $quantIssuesCriadas = 0;
         $quantCommitsFeitos = 0;
         $quantRepos = 0;

         // Filtrando pelos ultimos repositorios modificados
         $jsonString = json_encode($repos);
         $b = json_decode($jsonString);
         $collection = collect($b);
         $sorted = $collection->sortBy('updated_at');

         $commitsLastMonth = RequisicaoController::getCommitsLastMonth($nickname);

         //  Adiciona a quantidae commits feitos
        //  $quantCommitsFeitos = RequisicaoController::adicionaQuantCommitsFeitos($repos, $nickname,$quantCommitsFeitos);
        //  $info = RequisicaoController::acoesUser($nickname);
        //  $counter=0;
        //  foreach($info as $github_commit){
        //     if(isset($github_commit['type'])){
        //         if($github_commit['type'] == 'PushEvent' && Carbon::parse($github_commit['created_at'])->isToday()){
        //             $counter++;
        //         }
        //     }
        // }

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
            'bio' => $bio??""
        ];


        $user = User::create($data);

        foreach($commitsLastMonth as $commit) {
            // dd($commitsLastMonth);
            Commit::create([
                'user_id' => $user->id,
                'created_at' => $commit['created_at'],
            ]);
        }

        $token = Str::random(64);

        DB::table('password_resets')->insert([
            'email' => $email,
            'token' => bcrypt($token),
        ]);

        Auth::loginUsingId($user->id);

        $this->adicionaAtualizaRepositorios($repos);

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
    }

    public static function adicionaAtualizaRepositorios($repos){
        $items = [];
        if(isset($repos)){
            foreach ($repos as $repo) {
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
