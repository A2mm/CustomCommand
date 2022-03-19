<?php

namespace Tests\Feature\Schools;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CreateSchoolTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */

    public function create_school()
    {
        $faker      = \Faker\Factory::create();
        $form_data  = [
            'name'      => $faker->word,
        ];

        $user  = \App\Models\User::factory()->create();
        $this->actingAs($user, 'api');

        $response = $this->json('POST', route('schools.create'), $form_data, [
            'Accept' => 'application/json',
        ]);
        $response->assertJsonStructure([
            'data' => [
                "name",
                "updated_at",
                "created_at",
                "id",
            ], // end data 
        ]) // end structure
        ->assertStatus(201);
    }
}
