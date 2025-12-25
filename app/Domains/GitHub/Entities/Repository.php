<?php

namespace App\Domains\GitHub\Entities;

readonly class Repository
{
    public function __construct(
        public string $owner,
        public string $name,
        public string $fullName,
        public string $description,
        public bool $isPrivate,
        public string $htmlUrl,
        public string $cloneUrl,
        public ?string $language,
        public int $stars,
        public int $forks,
        public \DateTime $updatedAt,
    ) {}

    public static function fromApiResponse(array $data): self
    {
        return new self(
            owner: $data['owner']['login'],
            name: $data['name'],
            fullName: $data['full_name'],
            description: $data['description'] ?? '',
            isPrivate: $data['private'],
            htmlUrl: $data['html_url'],
            cloneUrl: $data['clone_url'],
            language: $data['language'],
            stars: $data['stargazers_count'],
            forks: $data['forks_count'],
            updatedAt: new \DateTime($data['updated_at']),
        );
    }
}