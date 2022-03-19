<?php

namespace Tests\Feature\Students;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UpdateStudentTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */

    public function update_student()
    {
        $school     = \App\Models\School::factory()->create();
        $student    = \App\Models\Student::factory()->create();
        $faker      = \Faker\Factory::create();
        $form_data  = [
            'name'      => $faker->word,
            'school_id' => $school->id,
        ];

        $user  = \App\Models\User::factory()->create();
        $this->actingAs($user, 'api');

         $response = $this->json('PUT', route('students.update', $student->id), $form_data, [
            'Accept' => 'application/json',
        ]);


        $response->assertJsonStructure([
            'data' => [
                "id",
                "name",
                "school_id",
                "order",
                "created_at",
                "updated_at",
                "deleted_at",
            ], // end data 
        ]) // end structure
        ->assertStatus(202);
    }
}
