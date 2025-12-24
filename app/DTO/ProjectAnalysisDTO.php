<?php

namespace App\DTO;

readonly class ProjectAnalysisDTO
{
    public function __construct(
        public string $phpVersion,
        public array $features, // ['redis', 'horizon', 'websockets', etc.]
        public string $database, // mysql, pgsql, sqlite
        public bool $hasScheduler,
        public bool $hasQueue,
    ) {}

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}