<?php

namespace Tests\Feature\Students;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class DeleteStudentTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */

    public function delete_student()
    {
        $schools   = \App\Models\School::factory()->count(3)->create();
        $item      = \App\Models\Student::factory()->create();
        $student   = $item->id;

        $user  = \App\Models\User::factory()->create();
        $this->actingAs($user, 'api');

        $response = $this->json('delete', '/api/v1/students/'.$student, [
            'Accept' => 'application/json',
        ]);

        $response->assertStatus(200);
    }
}
