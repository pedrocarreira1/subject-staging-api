<?php

declare(strict_types=1);

namespace Src\Subject\Application;

use Src\Repository\Domain\Entities\RepositoryEntity;
use Src\Repository\Domain\Entities\RepositoryID;
use Src\Subject\Domain\Contracts\SubjectRepositoryContract;
use Src\Subject\Domain\Entities\SubjectEntity;
use Src\Subject\Domain\Entities\SubjectName;

final class CreateSubjectUseCase
{
    private SubjectRepositoryContract $repository;

    public function __construct(SubjectRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @throws \Exception
     */
    public function __invoke(int $repositoryID, string $subjectName): void
    {
        // Param set
        $repositoryID = (new RepositoryID($repositoryID))->getId();
        $repository = new RepositoryEntity(['id' => $repositoryID]);

        $subjectName = (new SubjectName($subjectName))->getName();
        $subject = new SubjectEntity(['name' => $subjectName]);

        // todo: subjectAlreadyExistsUseCase validate if subject already exists, we could associate it to a repository
        // We Should Have an Endpoint for finding the subject like:
        // GET /subjects where subject Name =....

        // todo: repositoryExistsUseCase validate repositoryID exists in core API similar to SubjectId or Name...
        // We Should validate if Repository exists or not through:
        // GET /repositories/{repositoryID}

        // Validate if subject already exists in repository, at least with same name... we could have DNI for unique
        $checkIfSubjectExistsInRepositoryUseCase = new CheckIfSubjectExistsInRepositoryUseCase($this->repository);
        $checkIfSubjectExistsInRepositoryUseCase($repository, $subject);

        // Create subject
        $this->repository->store($repository, $subject);
    }

}
