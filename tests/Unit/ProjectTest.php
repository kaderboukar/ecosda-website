<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_project_can_be_created()
    {
        $project = Project::factory()->create([
            'title' => 'Nouveau Projet',
            'description' => 'Description du nouveau projet',
        ]);

        $this->assertDatabaseHas('projects', [
            'title' => 'Nouveau Projet',
            'description' => 'Description du nouveau projet',
        ]);
    }
}
