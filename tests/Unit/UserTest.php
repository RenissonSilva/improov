<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\User;

class UserTest extends TestCase
{
    /** @test */
    public function verificar_se_model_de_usuarios_esta_correto()
    {
        $user = new User();
        $expected = [
            'name', 'nickname', 'email', 'github_id', 'image', 'level','dateUpLevel','totalRepos',
            'experiencia','totalCommits', 'bio','ultimaAtualizacao', 'github_last_update'
        ];

        $arrayCompared = array_diff($expected,$user->getFillable());
        $this->assertEquals(0,count($arrayCompared));
    }
}
