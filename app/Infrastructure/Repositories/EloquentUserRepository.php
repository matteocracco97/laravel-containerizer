<?php

namespace App\Infrastructure\Repositories;

use App\Domains\User\Entities\User;
use App\Domains\User\Repositories\UserRepositoryInterface;
use App\Models\User as EloquentUser;

/**
 * Eloquent User Repository Implementation
 *
 * Implements the UserRepositoryInterface using Eloquent ORM.
 */
class EloquentUserRepository implements UserRepositoryInterface
{
    public function __construct(
        private EloquentUser $eloquentUser
    ) {}

    public function findById(int $id): ?User
    {
        $eloquentUser = $this->eloquentUser->find($id);
        return $eloquentUser ? User::fromArray($eloquentUser->toArray()) : null;
    }

    public function findByEmail(string $email): ?User
    {
        $eloquentUser = $this->eloquentUser->where('email', $email)->first();
        return $eloquentUser ? User::fromArray($eloquentUser->toArray()) : null;
    }

    public function findByGithubId(string $githubId): ?User
    {
        $eloquentUser = $this->eloquentUser->where('github_id', $githubId)->first();
        return $eloquentUser ? User::fromArray($eloquentUser->toArray()) : null;
    }

    public function save(User $user): void
    {
        $data = $user->toArray();
        unset($data['id']); // Remove id for updateOrCreate or save

        if ($user->id > 0) {
            $eloquentUser = $this->eloquentUser->find($user->id);
            if ($eloquentUser) {
                $eloquentUser->update($data);
            }
        } else {
            $eloquentUser = $this->eloquentUser->create($data);
            // Update the user id if it was auto-generated
            // But since User is immutable, perhaps return new instance, but for simplicity, assume id is set.
        }
    }

    public function delete(User $user): void
    {
        $eloquentUser = $this->eloquentUser->find($user->id);
        if ($eloquentUser) {
            $eloquentUser->delete();
        }
    }

    public function all(): array
    {
        return $this->eloquentUser->all()->map(fn($u) => User::fromArray($u->toArray()))->toArray();
    }

    public function updateOrCreateByGithubId(string $githubId, array $attributes): EloquentUser
    {
        return $this->eloquentUser->updateOrCreate(
            ['github_id' => $githubId],
            $attributes
        );
    }
}