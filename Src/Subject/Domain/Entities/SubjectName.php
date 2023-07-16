<?php

declare(strict_types=1);

namespace Src\Subject\Domain\Entities;

final class SubjectName
{
    /**
     * @var string
     */
    private string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        $this->customValidation();

        return $this->name;
    }

    /**
     * Further validations for name
     */
    private function customValidation(): void
    {
        // implement rules for string or name...
    }


}
