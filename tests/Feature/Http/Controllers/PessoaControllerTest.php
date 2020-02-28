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
    public function canStorePerson()
    {
        $pessoa = factory(Pessoa::class)->make([
            'identidade' => $this->faker->numerify('##.###.###'),
        ]);

        $response = $this->post('/api/pessoas', $pessoa->toArray());

        $response->assertJsonMissingValidationErrors('cpf');
        $response->assertJsonMissingValidationErrors('identidade');

        $response->assertStatus(201);
    }

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

    /**
     * @test
     */
    public function canUpdatePersonUniqueCPF()
    {
        factory(Pessoa::class)->create();

        $pessoa = factory(Pessoa::class)->create();

        $response = $this->json('PUT', '/api/pessoas/'.$pessoa->id, [
            'cpf' => $this->faker->numerify('###.###.###-##')
        ]);

        $response->assertJsonMissingValidationErrors('cpf');

        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function cannotUpdatePersonSameCPF()
    {
        factory(Pessoa::class)->create([
            'cpf' => $cpf = $this->faker->numerify('###.###.###-##')
        ]);

        $pessoa = factory(Pessoa::class)->create();

        $response = $this->json('PUT', '/api/pessoas/'.$pessoa->id, [
            'cpf' => $cpf
        ]);

        $response->assertJsonValidationErrors('cpf');

        $response->assertStatus(422);
    }

    /**
     * @test
     */
    public function cannotUpdatePersonSameIdentidade()
    {
        factory(Pessoa::class)->create([
            'identidade' => $rg = $this->faker->numerify('##.###.###')
        ]);

        $pessoa = factory(Pessoa::class)->create();

        $response = $this->json('PUT', '/api/pessoas/'.$pessoa->id, [
            'identidade' => $rg
        ]);

        $response->assertJsonValidationErrors('identidade');

        $response->assertStatus(422);
    }
}
