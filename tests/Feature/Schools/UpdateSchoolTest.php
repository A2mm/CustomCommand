<?php

namespace Tests\Feature\Schools;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UpdateSchoolTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */

    public function updte_school()
    {
        $item       = \App\Models\School::factory()->create();
        $faker      = \Faker\Factory::create();
        $form_data  = [
            'name'      => $faker->word,
        ];

        $user  = \App\Models\User::factory()->create();
        $this->actingAs($user, 'api');

        $response = $this->json('PUT', route('schools.update', $item->id), $form_data, [
            'Accept' => 'application/json',
        ]);

        $response->assertJsonStructure([
            'data' => [
                    "id",
                    "name",
                    "status",
                    "created_at",
                    "updated_at",
                    "deleted_at",
            ], // end data 
        ]) // end structure
        ->assertStatus(202);
    }
}
