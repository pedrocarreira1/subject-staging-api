<?php

declare(strict_types=1);

namespace Src\Repository\Domain\Entities;

final class RepositoryID
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
        // implement rules for integers or repository id...
    }


}
