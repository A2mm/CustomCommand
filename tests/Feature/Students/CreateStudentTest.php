<?php

namespace Tests\Feature\Students;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CreateStudentTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */

    public function create_student()
    {
        $school     = \App\Models\School::factory()->create();
        $faker      = \Faker\Factory::create();
        $form_data  = [
            'name'      => $faker->word,
            'school_id' => $school->id,
        ];

        $user  = \App\Models\User::factory()->create();
        $this->actingAs($user, 'api');

        $response = $this->json('POST', route('students.create'), $form_data, [
            'Accept' => 'application/json',
        ]);
        $response->assertJsonStructure([
            'data' => [
                "name",
                "school_id",
                "updated_at",
                "created_at",
                "id",
            ], // end data 
        ]) // end structure
        ->assertStatus(201);
    }
}
