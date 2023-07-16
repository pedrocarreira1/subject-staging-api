<?php

namespace Src\Subject\Domain\Entities;

class SubjectID
{
    private string $subjectID;

    public function __construct(int $subjectID)
    {
        $this->subjectID = $subjectID;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        $this->customValidation();

        return $this->subjectID;
    }

    /**
     * Further validations for name
     */
    private function customValidation(): void
    {
        // implement rules for integer, ID...
    }
}
