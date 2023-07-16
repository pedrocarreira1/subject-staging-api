<?php

namespace Src\Subject\Application;

use Src\Project\Domain\Entities\ProjectEntity;
use Src\Project\Domain\Entities\ProjectID;
use Src\Repository\Domain\Entities\RepositoryEntity;
use Src\Repository\Domain\Entities\RepositoryID;
use Src\Subject\Domain\Contracts\SubjectRepositoryContract;
use Src\Subject\Domain\Entities\SubjectEntity;
use Src\Subject\Domain\Entities\SubjectID;

final class AssignProjectToSubject
{
    private SubjectRepositoryContract $repository;

    public function __construct(SubjectRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @throws \Exception
     */
    public function __invoke(int $repositoryID, int $subjectID, int $projectID): void
    {
        // Param set
        $repositoryID = (new RepositoryID($repositoryID))->getId();
        $repository = new RepositoryEntity(['id' => $repositoryID]);

        $subjectID = (new SubjectID($subjectID))->getId();
        $subject = new SubjectEntity(['id' => $subjectID]);

        $projectID = (new ProjectID($projectID))->getId();
        $project = new ProjectEntity(['id' => $projectID]);

        // todo: subjectExistsUseCase validate if subject exists
        // We Should Have an Endpoint for finding the subject like:
        // GET /subjects/{subjectID}

        // todo: projectExistsUseCase validate if project exists
        // We Should Have an Endpoint for finding the subject like:
        // GET /projects/{projectID}

        // Check if subject is already assigned to a project inside repository
        $checkIfSubjectIsAlreadyAssignedToAProjectUseCase = new CheckIfSubjectIsAlreadyAssignedToAProjectUseCase($this->repository);
        $checkIfSubjectIsAlreadyAssignedToAProjectUseCase($repository, $subject, $project);

        // We could want to detach the subject from a project to another project inside the repository...

        // Create subject
        $this->repository->assignToProject($repository, $subject, $project);
    }
}
