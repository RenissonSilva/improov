<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FriendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::id();
        $amigos = DB::table('friends AS f')->join('users AS u', 'u.id', 'f.usuario1')
            ->join('users AS u2', 'u2.id', 'f.usuario2')
            ->select(
                'u.name AS nomeUsuario1',
                'u2.name AS nomeUsuario2',
                'u.level AS levelUsuario1',
                'u2.level AS levelUsuario2',
                'f.*'
            )
            ->where('status', 'a')
            ->where(function ($query) {
                $query->orwhere('f.usuario1', '=', Auth::id())
                    ->orwhere('f.usuario2', '=', Auth::id());
            })
            ->paginate(10);

        return view('friends.index', compact('amigos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request);
        return redirect()->route('friends.adicionaAmigo');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Adiciona Amigo
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function adicionaAmigo()
    {
        $amigos = DB::table('friends AS f')->where(function ($query) {
            return $query->orwhere('f.usuario1', Auth::id())
                ->orwhere('f.usuario2', Auth::id());
        })->select('f.usuario1', 'f.usuario2')
            ->get();
        $lista = [];
        foreach ($amigos as $a) {
            if ($a->usuario1 == Auth::id()) {
                $lista[] = $a->usuario2;
            } else {
                $lista[] = $a->usuario1;
            }
        }
        $users = DB::table('users')->whereNotIn('id', $lista)->get();
        return view('friends.adicionaAmigo', compact('users'));
    }

    // Métodos referentes a adicionar amigo
    public function mandaConvite(Request $r)
    {
        DB::insert(
            'insert into invitation_friends (usuario1, usuario2, created_at)
                                        values (?,?,?)',
            [
                Auth::id(),
                $r->usuario2,
                date('Y/m/d H:i:s')
            ]
        );
        return redirect()->route('friends.adicionaAmigo')->with('success', 'Convite enviado com sucesso!');
    }
    public function recusaConvite($id)
    {
        //recusa convite
        $conviteSeraoRecusados = DB::table('invitation_friends')->where('status', 'p')->pluck('id');
        DB::update('update invitation_friends set status = "r" where id in (' . $id . ')');

        return redirect()->route('friends.solicitacoes');
    }
    public function aceitaConvite($id)
    {
        //Aceita convite
        DB::update('update invitation_friends set status = "r" where id = ?', [$id]);

        //Aceita amigo
        $solicitacao = DB::table('invitation_friends')->where('id', $id)->first();
        DB::insert(
            'insert into friends(usuario1, usuario2, created_at)
                                        values (?,?,?)',
            [
                $solicitacao->usuario1,
                Auth::id(),
                date('Y/m/d H:i:s')
            ]
        );

        return redirect()->route('friends.solicitacoes')->with('success', 'Convite aceito com sucesso!');
    }
    public function removeAmigo($id)
    {
        //Remove convite
        DB::update('update friends set status = "r" where id = ?', [$id]);

        return redirect()->route('friends.index');
    }
    public function bloqueiaAmigo()
    {
    }
    // Métodos visuais referentes a adicionar amigo
    public function solicitacoes()
    {
        $solicitacoes = DB::table('invitation_friends AS if')->join('users AS u', 'u.id', 'if.usuario1')
            // ->join('users AS u2','u2.id','if.usuario2')
            ->where('if.usuario2', Auth::id())
            ->where('if.status', 'p')
            ->select('if.id', 'if.status', 'u.name AS usuario')
            // ->select('if.id','if.status','u1.name1','u2.name2')
            ->paginate(10);

        return view('friends.solicitacoes', compact('solicitacoes'));
    }
    public function visualizaSolicitacoes()
    {
    }
}
