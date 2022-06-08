<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class RegisterDuskTest extends DuskTestCase
{
    /** @test */
    public function testExample()
    {
        // $user = User::factory()->create([
        //     'email' => 'taylor@laravel.com',
        // ]);

        $this->browse(function (Browser $browser){
            $browser->assertAuthenticated()
                    ->visit('/user/repos');
                    // ->press('#span304')
                    // ->clickLink('Já tenho conta')
                    // ->type('email', $user->email)
                    // ->type('password', 'password')
                    // ->assertPathIs('/user/home');
        });


        // $this->browse(function (Browser $browser) {
        //     $browser->visit('/')
        //             ->assertSee('Improov')
        //             ->assertSee('Viemos para te ajudar a focar em seus objetivos e a aperfeiçoar seus conhecimentos para que você esteja mais perto da força! ');
        // });
    }
}
