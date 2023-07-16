<?php

declare(strict_types=1);

namespace Src\Subject\Application;

use Src\Project\Domain\Entities\ProjectEntity;
use Src\Repository\Domain\Entities\RepositoryEntity;
use Src\Subject\Domain\Contracts\SubjectRepositoryContract;
use Src\Subject\Domain\Entities\SubjectEntity;
use Symfony\Component\HttpFoundation\Response;

final class CheckIfSubjectIsAlreadyAssignedToAProjectUseCase
{
    private SubjectRepositoryContract $repository;

    public function __construct(SubjectRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(RepositoryEntity $repository, SubjectEntity $subject, ProjectEntity $project): void
    {
        $subjectProjectsInRepository = $this->repository->getSubjectProjectsInRepository($repository, $subject,
            $project);

        if (! $subjectProjectsInRepository->isEmpty()) {
            throw new \Exception('Error: Subject already assigned to a project', Response::HTTP_CONFLICT);
        }
    }

}
