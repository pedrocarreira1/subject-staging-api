<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Src\Subject\Infrastructure\Repositories\SubjectEloquentRepository;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class SubjectTest extends TestCase
{

    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->baseUrl = 'api/v1/';
        $this->repositoryID = 1;
        $this->subjectID = 1;
        $this->projectID = 1;
    }

    /**
     * A basic feature test example.
     */
    public function test_create_subject(): void
    {
        // We also could create factories for the entities
        $response = $this->postJson($this->baseUrl . 'repositories/' . $this->repositoryID .  '/subjects', [
            'name' => 'Peter Kane',
        ]);

        $response->assertStatus(Response::HTTP_CREATED);
        $response->assertJson([
            'message' => 'Subject created successfully.',
        ]);
    }

    public function test_assign_project_to_subject()

    {
        // We also could create factories for the entities
        $response = $this->postJson($this->baseUrl .'repositories/' . $this->repositoryID . '/subjects/'.
            $this->subjectID . '/projects/' . $this->projectID);

        $response->assertStatus(200);
        $response->assertJson([
            'message' => 'Subject associated to project successfully.',
        ]);
    }

    public function test_filter_subjects()
    {
        $response = $this->postJson($this->baseUrl .'repositories/' . $this->repositoryID . '/subjects/filter', [
            'name' => 'Peter Kane',
            'age'  => 30,
        ]);

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJson([
            'message' => 'Subjects filtered successfully.',
        ]);

        // Assert the expected results
    }
}
