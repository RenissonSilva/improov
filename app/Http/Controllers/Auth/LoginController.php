<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;
use DB;
use Auth;
use App\User;
use Illuminate\Support\Str;

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
    protected $redirectTo = RouteServiceProvider::HOME;

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
        $email = $user_github->getEmail();
        $github_id = $user_github->getId();
        $image = $user_github->getAvatar();

        $search_user = User::where('email', $email)->first();

        if($search_user){
            Auth::loginUsingId($search_user->id);
            return redirect('/home');
        }else{
            $data = [
                'name' => $name,
                'email' => $email ,
                'github_id' => $github_id,
                'xp' => 0,
                'image' => $image,
            ];
    
            $user = User::create($data);
    
            $token = Str::random(64);
    
            DB::table('password_resets')->insert([
                'email' => $email,
                'token' => bcrypt($token),
            ]);
    
            Auth::loginUsingId($user->id);
            return redirect('/home');
        }
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
