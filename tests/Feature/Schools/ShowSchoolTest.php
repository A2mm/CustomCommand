<?php

namespace Tests\Feature\Schools;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ShowSchoolTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function view_one_school()
    {
        $item   = \App\Models\School::factory()->create();
        $school = $item->id;

        $user       = \App\Models\User::factory()->create();
        $this->actingAs($user, 'api');
    

         $response = $this->json('GET', '/api/v1/school/'.$school, [], [
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
                ->assertStatus(200);
    }
}
