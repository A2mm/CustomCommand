<?php

namespace Tests\Feature\Students;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class StudentsTest extends TestCase
{
    use DatabaseMigrations;
    
    /** @test */
    public function show_students()
    {
        $schools = \App\Models\School::factory()->count(3)->create();
        $items   = \App\Models\Student::factory()->count(3)->create();
        $user    = \App\Models\User::factory()->create();
        $this->actingAs($user, 'api');
    

         $response = $this->json('GET', '/api/v1/students/', [
            'Accept' => 'application/json',
        ]);

        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    "id",
                    "name",
                    "school_id",
                    "order",
                    "created_at",
                    "updated_at",
                    "deleted_at",
                ]
            ], // end data 
        ]) // end structure
        ->assertStatus(200);
    }
}