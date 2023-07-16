<?php

declare(strict_types=1);

namespace Src\Subject\Infrastructure\Repositories;

use App\Exceptions\ApiException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Src\Project\Domain\Entities\ProjectEntity;
use Src\Repository\Domain\Entities\RepositoryEntity;
use Src\Subject\Domain\Contracts\SubjectRepositoryContract;
use Src\Subject\Domain\Entities\SubjectEntity;

final class SubjectEloquentRepository implements SubjectRepositoryContract
{
    private string $baseUrl;

    public function __construct()
    {
        $this->baseUrl =  'api.cmrad.com/API/v1/';
    }

    /**
     * @param RepositoryEntity $repository
     * @param SubjectEntity    $subject
     *
     * @return void
     * @throws ApiException
     */
    public function store(RepositoryEntity $repository, SubjectEntity $subject): void
    {
        // Send a POST request to the Core API to create the subject
        $response = Http::post($this->baseUrl . 'repositories/'. $repository->getId() . '/subjects', $subject->toArray());

        // Check the response status and return the appropriate response
        if ($response->failed()) {
            $responseObject = json_decode($response->body());
            throw new ApiException($responseObject->message, $responseObject->status);
        }
    }

    /**
     * @param RepositoryEntity $repository
     * @param SubjectEntity    $subject
     * @param ProjectEntity    $project
     *
     * @return void
     * @throws ApiException
     */
    public function assignToProject(RepositoryEntity $repository, SubjectEntity $subject, ProjectEntity $project): void
    {
        // Send a POST request to the Core API to assign project to the subject
        $response = Http::post($this->baseUrl . 'repositories/'. $repository->getId() . '/subjects/' . $subject->getId() . '/projects/' . $project->getId());

        // Check the response status and return the appropriate response
        if ($response->failed()) {
            $responseObject = json_decode($response->body());
            throw new ApiException($responseObject->message, $responseObject->status);
        }
    }

    /**
     * @param RepositoryEntity $repository
     * @param array            $criteria
     *
     * @return Collection
     * @throws ApiException
     */
    public function filter(RepositoryEntity $repository, array $criteria): Collection
    {
        // Implementation to filter subjects based on the provided criteria
        // Example implementation:
        $response = Http::get('api.cmrad.com/API/v1/repositories/{repositoryID}/subjects', $criteria);

        $responseObject = json_decode($response->body());
        if ($response->failed()) {
            throw new ApiException($responseObject->message, $responseObject->status);
        }

        // Depends on core api response...
        return collect($responseObject->data);
    }

    /**
     * @param RepositoryEntity $repository
     * @param SubjectEntity    $subject
     *
     * @return Collection
     * @throws ApiException
     */
    public function findInRepository(RepositoryEntity $repository, SubjectEntity $subject): Collection
    {
        // Send a Get request to the Core API to find the subject in the Repository
        $response = Http::get($this->baseUrl . 'repositories/'. $repository->getId() . '/subjects');

        $responseObject = json_decode($response->body());
        if ($response->failed()) {
            throw new ApiException($responseObject->message, $responseObject->status);
        }
        // Depends on core api response...
        $dataCollection = collect($responseObject->data);

        // We could return a boolean too...
        return $dataCollection->where('name', $subject->getName())->first();
    }

    /**
     * @param RepositoryEntity $repository
     * @param SubjectEntity    $subject
     * @param ProjectEntity    $project
     *
     * @return Collection
     * @throws ApiException
     */
    public function getSubjectProjectsInRepository(RepositoryEntity $repository, SubjectEntity $subject, ProjectEntity $project): Collection
    {
        // Send a Get request to the Core API to find the subject in the Repository
        // todo: should exist or create endpoint in core...
        $response = Http::get($this->baseUrl . 'repositories/'. $repository->getId() . '/subjects/' . $subject->getId() . '/projects');

        $responseObject = json_decode($response->body());
        if ($response->failed()) {
            throw new ApiException($responseObject->message, $responseObject->status);
        }

        // We could return a boolean too...
        return collect($responseObject->data);
    }
}
