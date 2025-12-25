<?php

namespace App\Domains\GitHub\Services;

use App\Domains\GitHub\Entities\Repository;
use Illuminate\Support\Facades\Http;

class GitHubApiService
{
    public function __construct(
        private string $baseUrl = 'https://api.github.com'
    ) {}

    /**
     * Get user repositories
     */
    public function getUserRepositories(string $token, int $perPage = 30): array
    {
        $response = Http::withToken($token)
            ->get("{$this->baseUrl}/user/repos", [
                'sort' => 'updated',
                'per_page' => $perPage,
            ]);

        if ($response->failed()) {
            throw new \Exception('Failed to fetch repositories: ' . $response->body());
        }

        $repos = $response->json();

        return array_map(fn($repo) => Repository::fromApiResponse($repo), $repos);
    }

    /**
     * Get composer.json content from a repository
     */
    public function getComposerJson(string $token, string $owner, string $repo): string
    {
        $response = Http::withToken($token)
            ->get("{$this->baseUrl}/repos/{$owner}/{$repo}/contents/composer.json");

        if ($response->failed()) {
            throw new \Exception('Failed to fetch composer.json: ' . $response->body());
        }

        $data = $response->json();

        if (!isset($data['content'])) {
            throw new \Exception('composer.json not found in repository');
        }

        return base64_decode($data['content']);
    }

    /**
     * Get repository information
     */
    public function getRepository(string $token, string $owner, string $repo): Repository
    {
        $response = Http::withToken($token)
            ->get("{$this->baseUrl}/repos/{$owner}/{$repo}");

        if ($response->failed()) {
            throw new \Exception('Failed to fetch repository: ' . $response->body());
        }

        return Repository::fromApiResponse($response->json());
    }
}