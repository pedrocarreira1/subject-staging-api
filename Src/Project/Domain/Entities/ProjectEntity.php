<?php

declare(strict_types=1);

namespace Src\Project\Domain\Entities;

class ProjectEntity
{
    private mixed $id;

    public function __construct(array $params)
    {
        $this->id = $params['id'] ?? null;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id
        ];
    }
}
