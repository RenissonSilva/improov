<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Laravel\Socialite\Facades\Socialite;

class RequisicaoController extends Controller
{
    public static function acoesUser($nickname){
        try {
            $public = Http::get('https://api.github.com/users/'.$nickname.'/events/public')->json();
            if(isset($public['message']) && $public['mensagem'] == "API rate limit exceeded for 186.233.109.156. (But here's the good news: Authenticated requests get a higher rate limit. Check out the documentation for more details.)"){
                return redirect('/error');
            }
            return $public;
        } catch (Exception $e) {
            return redirect('/error');
        }
    }
    public static function getUser(){
        try {
            $socialite = Socialite::driver('github')->user();
            // Verifica rate Limit
            if(isset($socialite['message']) && $socialite['mensagem'] == "API rate limit exceeded for 186.233.109.156. (But here's the good news: Authenticated requests get a higher rate limit. Check out the documentation for more details.)"){
                return redirect('/error');
            }
            return $socialite;
        } catch (Exception $e) {
            return redirect('/error');
        }
    }
    public static function getRepositorios($nickname){
        try {
            $repos = Http::get('https://api.github.com/users/'.$nickname.'/repos')->json();
            // //Verifica se irei usar esse!
            // $repos = Http::get('https://api.github.com/users/'.$nickname.'/repos',[
            //     'per_page' => 100,
            //     'sort' => 'updated',
            // ]);

            // Verifica rate Limit
            if(isset($repos['message']) && $repos['mensagem'] == "API rate limit exceeded for 186.233.109.156. (But here's the good news: Authenticated requests get a higher rate limit. Check out the documentation for more details.)"){
                return redirect('/error');
            }

            return $repos;
        } catch (Exception $e) {
            return redirect('/error');
        }
    }
    public static function atualizaQuantCommitsFeitos($sorted, $user,$nickname,$quantCommitsFeitos){
        try{
            foreach( $sorted as $s){
                // if(new DateTime($s->updated_at) >= new DateTime($user->ultimaAtualizacao)){
                if(1 == 2){
                    $contribuidores = Http::get($s->contributors_url)->json();
                    // Verifica rate Limit
                    if(isset($contribuidores['message']) && $contribuidores['mensagem'] == "API rate limit exceeded for 186.233.109.156. (But here's the good news: Authenticated requests get a higher rate limit. Check out the documentation for more details.)"){
                        return redirect('/error');
                    }

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
    }


    public static function adicionaQuantCommitsFeitos($repos,$nickname,$quantCommitsFeitos){
        try{
            foreach($repos as $r){
                $contribuidores = Http::get($r['contributors_url'])->json();
                // Verifica rate Limit
                if(isset($contribuidores['message']) && $contribuidores['mensagem'] == "API rate limit exceeded for 186.233.109.156. (But here's the good news: Authenticated requests get a higher rate limit. Check out the documentation for more details.)"){
                    return redirect('/error');
                }

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
    }
}
