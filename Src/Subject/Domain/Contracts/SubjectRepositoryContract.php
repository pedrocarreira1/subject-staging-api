<?php

declare(strict_types=1);

namespace Src\Subject\Domain\Contracts;

use Illuminate\Support\Collection;
use Src\Project\Domain\Entities\ProjectEntity;
use Src\Repository\Domain\Entities\RepositoryEntity;
use Src\Subject\Domain\Entities\SubjectEntity;

interface SubjectRepositoryContract
{
    public function store(RepositoryEntity $repository, SubjectEntity $subject): void;
    public function assignToProject(RepositoryEntity $repository, SubjectEntity $subject, ProjectEntity $project);
    public function filter(RepositoryEntity $repository, array $criteria): Collection;
    public function findInRepository(RepositoryEntity $repository, SubjectEntity $subject): Collection;
    public function getSubjectProjectsInRepository(RepositoryEntity $repository, SubjectEntity $subject, ProjectEntity $project): Collection;
}
