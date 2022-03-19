<?php

namespace Tests\Feature\Schools;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class SchoolsTest extends TestCase
{
    use DatabaseMigrations;
    
    /** @test */
    public function show_schools()
    {
        $items   = \App\Models\School::factory()->count(3)->create();
        $user       = \App\Models\User::factory()->create();
        $this->actingAs($user, 'api');
    

         $response = $this->json('GET', '/api/v1/schools/', [
            'Accept' => 'application/json',
        ]);

        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    "id",
                    "name",
                    "status",
                    "created_at",
                    "updated_at",
                    "deleted_at",
                ]
            ], // end data 
        ]) // end structure
                ->assertStatus(200);
    }
}
