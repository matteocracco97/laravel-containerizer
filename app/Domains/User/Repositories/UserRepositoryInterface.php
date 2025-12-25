<?php

namespace App\Domains\User\Repositories;

use App\Domains\User\Entities\User;
use App\Models\User as EloquentUser;

/**
 * User Repository Interface
 *
 * Defines the contract for user data access operations.
 */
interface UserRepositoryInterface
{
    /**
     * Find a user by ID
     */
    public function findById(int $id): ?User;

    /**
     * Find a user by email
     */
    public function findByEmail(string $email): ?User;

    /**
     * Find a user by GitHub ID
     */
    public function findByGithubId(string $githubId): ?User;

    /**
     * Save a user
     */
    public function save(User $user): void;

    /**
     * Delete a user
     */
    public function delete(User $user): void;

    /**
     * Get all users
     */
    public function all(): array;

    /**
     * Update or create a user by GitHub ID
     */
    public function updateOrCreateByGithubId(string $githubId, array $attributes): EloquentUser;
}