<?php

namespace Tests\Feature\Schools;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class DeleteSchoolTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */

    public function delete_school()
    {
        $item      = \App\Models\School::factory()->create();
        $school    = $item->id;

        $user  = \App\Models\User::factory()->create();
        $this->actingAs($user, 'api');

        $response = $this->json('delete', '/api/v1/schools/'.$school, [
            'Accept' => 'application/json',
        ]);

        $response->assertStatus(200);
    }
}
