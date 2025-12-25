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
     * Get user repositories with optional search and pagination
     */
    public function getUserRepositories(string $token, string $query = null, int $page = 1, int $perPage = 30): array
    {
        if ($query) {
            // Use search API for filtering
            $response = Http::withToken($token)
                ->get("{$this->baseUrl}/search/repositories", [
                    'q' => "user:" . $this->getUsernameFromToken($token) . " {$query}",
                    'sort' => 'updated',
                    'per_page' => $perPage,
                    'page' => $page,
                ]);

            if ($response->failed()) {
                throw new \Exception('Failed to search repositories: ' . $response->body());
            }

            $data = $response->json();
            $repos = $data['items'] ?? [];
        } else {
            // Use user repos API
            $response = Http::withToken($token)
                ->get("{$this->baseUrl}/user/repos", [
                    'sort' => 'updated',
                    'per_page' => $perPage,
                    'page' => $page,
                ]);

            if ($response->failed()) {
                throw new \Exception('Failed to fetch repositories: ' . $response->body());
            }

            $repos = $response->json();
        }

        return array_map(fn($repo) => Repository::fromApiResponse($repo), $repos);
    }

    /**
     * Get username from token (for search API)
     */
    private function getUsernameFromToken(string $token): string
    {
        $response = Http::withToken($token)->get("{$this->baseUrl}/user");

        if ($response->failed()) {
            throw new \Exception('Failed to get user info: ' . $response->body());
        }

        return $response->json()['login'];
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