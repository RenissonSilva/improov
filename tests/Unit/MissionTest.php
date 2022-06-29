<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\Auth;
use Mockery;
use Tests\TestCase;

class MissionTest extends TestCase
{
    protected $symbolMock;
    /**
        @test
    */
    public function se_nao_estiver_logado_o_usuario_nao_pode_ver_as_missoes()
    {
        $response = $this->get('user/mission')->assertRedirect('/');
        $this->assertEquals(302,$response->getStatusCode());
    }

    /**
        @test
    */
    public function verifica_se_adiciona_missao(){
        $this->mockAuthUser();
        //$this->withoutMiddleware();
        Session::start();
        $missao = [
            'name' => 'Tirar nota 10',
            'repeat_mission'=>0,
            '_token' => csrf_token()
        ];
        $response = $this->withHeaders([
            'X-Header' => 'Value',
        ])->json('POST', 'user/mission/store', $missao);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /**
        @test
    */
    public function verifica_se_a_missao_existe_no_sistema()
    {
        $this->assertDatabaseHas('missions', [
            'name' => 'Tirar nota 10',
            'repeat_mission'=>0
        ]);
    }

    protected function mockAuthUser(){
        $user = new User([
            'name' => 'teste'
        ]);

        $this->be($user);
    }
}
