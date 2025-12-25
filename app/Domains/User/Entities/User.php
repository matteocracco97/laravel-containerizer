<?php

namespace App\Domains\User\Entities;

use DateTimeImmutable;

/**
 * User Domain Entity
 *
 * Represents a user in the domain layer with business logic.
 */
class User
{
    public function __construct(
        public readonly int $id,
        public string $name,
        public string $email,
        public ?string $password,
        public ?string $githubId,
        public ?string $githubToken,
        public ?string $githubRefreshToken,
        public ?string $avatar,
        public ?DateTimeImmutable $emailVerifiedAt,
        public DateTimeImmutable $createdAt,
        public DateTimeImmutable $updatedAt,
    ) {}

    /**
     * Create a new User instance from array data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'] ?? 0,
            name: $data['name'],
            email: $data['email'],
            password: $data['password'] ?? null,
            githubId: $data['github_id'] ?? null,
            githubToken: $data['github_token'] ?? null,
            githubRefreshToken: $data['github_refresh_token'] ?? null,
            avatar: $data['avatar'] ?? null,
            emailVerifiedAt: isset($data['email_verified_at']) ? new DateTimeImmutable($data['email_verified_at']) : null,
            createdAt: new DateTimeImmutable($data['created_at'] ?? 'now'),
            updatedAt: new DateTimeImmutable($data['updated_at'] ?? 'now'),
        );
    }

    /**
     * Convert to array for persistence
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'github_id' => $this->githubId,
            'github_token' => $this->githubToken,
            'github_refresh_token' => $this->githubRefreshToken,
            'avatar' => $this->avatar,
            'email_verified_at' => $this->emailVerifiedAt?->format('Y-m-d H:i:s'),
            'created_at' => $this->createdAt->format('Y-m-d H:i:s'),
            'updated_at' => $this->updatedAt->format('Y-m-d H:i:s'),
        ];
    }

    /**
     * Business logic: Change user's email
     */
    public function changeEmail(string $newEmail): void
    {
        // Add validation logic here if needed
        $this->email = $newEmail;
    }

    /**
     * Business logic: Verify email
     */
    public function verifyEmail(): void
    {
        $this->emailVerifiedAt = new DateTimeImmutable();
    }

    /**
     * Check if email is verified
     */
    public function isEmailVerified(): bool
    {
        return $this->emailVerifiedAt !== null;
    }
}