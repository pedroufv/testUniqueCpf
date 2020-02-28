<?php

namespace Tests\Feature\Http\Controllers;

use App\Pessoa;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PessoaControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * @test
     */
    public function canStorePersonUniqueCPF()
    {
        $pessoa = factory(Pessoa::class)->make();

        $response = $this->post('/api/pessoas', $pessoa->toArray());

        $response->assertJsonMissingValidationErrors('cpf');

        $response->assertStatus(201);
    }

    /**
     * @test
     */
    public function cannotStorePersonSameCPF()
    {
        factory(Pessoa::class)->create([
            'cpf' => $cpf = $this->faker->numerify('###.###.###-##')
        ]);

        $pessoa = factory(Pessoa::class)->make([
            'cpf' => $cpf
        ]);

        $response = $this->json('POST', '/api/pessoas', $pessoa->toArray());

        $response->assertJsonValidationErrors('cpf');

        $response->assertStatus(422);
    }
}
