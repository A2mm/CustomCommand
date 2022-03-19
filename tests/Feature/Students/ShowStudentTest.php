<?php

namespace Tests\Feature\Students;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ShowStudentTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function view_one_student()
    {
        $schools = \App\Models\School::factory()->count(3)->create();
        $item    = \App\Models\Student::factory()->create();
        $student = $item->id;

        $user       = \App\Models\User::factory()->create();
        $this->actingAs($user, 'api');
    

         $response = $this->json('GET', '/api/v1/student/'.$student, [], [
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
        ->assertStatus(200);
    }
}
