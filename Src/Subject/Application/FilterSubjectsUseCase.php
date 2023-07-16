<?php

namespace Src\Subject\Application;

use Illuminate\Support\Collection;
use Src\Repository\Domain\Entities\RepositoryEntity;
use Src\Repository\Domain\Entities\RepositoryID;
use Src\Subject\Domain\Contracts\SubjectRepositoryContract;

class FilterSubjectsUseCase
{
    private SubjectRepositoryContract $repository;

    public function __construct(SubjectRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @throws \Exception
     */
    public function __invoke(int $repositoryID, array $criteria): Collection
    {
        // Param set
        $repositoryID = (new RepositoryID($repositoryID))->getId();
        $repository = new RepositoryEntity(['id' => $repositoryID]);

        // Create subject
        return $this->repository->filter($repository, $criteria);
    }
}
