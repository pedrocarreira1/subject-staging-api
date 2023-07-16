<?php

declare(strict_types=1);

namespace Src\Project\Domain\Entities;

class ProjectID
{
    /**
     * @var integer
     */
    private int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        $this->customValidation();

        return $this->id;
    }

    /**
     * Further validations for name
     */
    private function customValidation(): void
    {
        // implement rules for integers or project id...
    }

}
