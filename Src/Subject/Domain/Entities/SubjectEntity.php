<?php

declare(strict_types=1);

namespace Src\Subject\Domain\Entities;

final class SubjectEntity
{
    private mixed $id;
    private mixed $name;

    public function __construct(array $params)
    {
        $this->id = $params['id'] ?? null;
        $this->name = $params['name'] ?? null;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name
        ];
    }
}
