<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    // Se algum teste for alterar dados do banco de dados use:
    use RefreshDatabase;
    // para restaurar o bd original

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    // Mma maneira de identificar o método como teste é usando um @test no
    // comentário anterior ao método. Outra meneira é iniciando o nome
    // do método com test, exemplo test_user_can_login()

    // Para nomear os métodos, usar snake_case é uma boa ideia.

    // Também podemos usar a seguinte técnica para desenvolver o método:
    // Given: I am a user who wants do login
    // When: they hit de login button, while passing the necessary authentication
    // Then: the user is logged in and redirected to home page
}
