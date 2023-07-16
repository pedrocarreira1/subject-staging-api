<?php

declare(strict_types=1);

namespace Src\Subject\Application;

use Src\Repository\Domain\Entities\RepositoryEntity;
use Src\Subject\Domain\Contracts\SubjectRepositoryContract;
use Src\Subject\Domain\Entities\SubjectEntity;
use Symfony\Component\HttpFoundation\Response;

final class CheckIfSubjectExistsInRepositoryUseCase
{
    private SubjectRepositoryContract $repository;

    public function __construct(SubjectRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(RepositoryEntity $repository, SubjectEntity $subject): void
    {
        $subjectInRepository = $this->repository->findInRepository($repository, $subject);

        if (! $subjectInRepository->isEmpty()) {
            throw new \Exception('Error: Subject already exists in the Repository', Response::HTTP_CONFLICT);
        }
    }
}
