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
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;


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
        $user_github = Socialite::driver('github')->user();

        $name = $user_github->getName() ?? $user_github->getNickname();
        $nickname = $user_github->getNickname();
        $email = $user_github->getEmail();
        $github_id = $user_github->getId();
        $image = $user_github->getAvatar();

        $search_user = User::where('email', $email)->first();

        if($search_user){




            Auth::loginUsingId($search_user->id);

            $github_info = Http::get('https://api.github.com/users/'.Auth::user()->nickname.'/events/public');
            // dd($github_info->json());
            $dateLevel = Carbon::parse(Auth::user()->dateUpLevel)->valueOf();

            foreach($github_info->json() as $git){

                $created_at[] = Carbon::parse($git['created_at'])->valueOf();
            }
            $c=0;
            foreach($created_at as $created){

                if($dateLevel < $created){
                    $c++;
                }
            }

            $this->verificaUpLevel(Auth::user(),$c);
            return redirect('/user/home');
        }else{
            $data = [
                'name' => $name,
                'nickname' => $nickname,
                'email' => $email ,
                'github_id' => $github_id,
                'xp' => 0,
                'image' => $image,
                'dateUpLevel' => date('Y-m-d H:i:s')
            ];

            $user = User::create($data);

            $token = Str::random(64);

            DB::table('password_resets')->insert([
                'email' => $email,
                'token' => bcrypt($token),
            ]);

            Auth::loginUsingId($user->id);
            return redirect('/user/home');
        }
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    private function subirLevel($userId,$level){
        $levelUp = (int) $level+1;
        DB::table('users')->where('id',$userId)->update(['dateUplevel'=>date('Y-m-d H:i:s'),'level'=>$levelUp]);
        $this->addMissionWhenUpdateLevel($userId,$levelUp);

        return response()->json('Subiu de level com sucesso!');
    }
    private function addMissionWhenUpdateLevel($userId,$level){
        $missoes = DB::table('missions')->where('level_mission',$level)->get();
        foreach($missoes as $m){
            Mission_user::create(
                ['user_id' => $userId, 'mission_id' => $m->id, 'mission_user_points'=>0,'completed'=>0]
            );
        }

    }
    private function verificaUpLevel($auth,$quantityCommits){
        if($auth->level == 1){
            if($quantityCommits > 1){
                $this->subirLevel(Auth::id(), Auth::user()->level);
            }
        }elseif($auth->level == 2){
            if($quantityCommits > 2){
                $this->subirLevel(Auth::id(), Auth::user()->level);
            }
        }elseif($auth->level == 3){
            if($quantityCommits > 3){
                $this->subirLevel(Auth::id(), Auth::user()->level);
            }
        }elseif($auth->level == 4){
            if($quantityCommits > 5){
                $this->subirLevel(Auth::id(), Auth::user()->level);
            }
        }elseif($auth->level == 5){
            if($quantityCommits > 20){
                $this->subirLevel(Auth::id(), Auth::user()->level);
            }
        }
    }
}
