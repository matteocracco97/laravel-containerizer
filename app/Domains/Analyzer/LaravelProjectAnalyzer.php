<?php

namespace App\Domains\Analyzer;

use App\DTO\ProjectAnalysisDTO;

class LaravelProjectAnalyzer
{
    public function analyze(string $composerJsonContent, ?string $envContent = null): ProjectAnalysisDTO
    {
        $composer = json_decode($composerJsonContent, true);
        $require = $composer['require'] ?? [];
        $requireDev = $composer['require-dev'] ?? [];
        $allDeps = array_merge($require, $requireDev);

        return new ProjectAnalysisDTO(
            phpVersion: $this->detectPhpVersion($require['php'] ?? '^8.2'),
            features: $this->detectFeatures($allDeps),
            database: $this->detectDatabase($envContent),
            hasScheduler: true,
            hasQueue: $this->detectQueue($allDeps),
        );
    }

    private function detectPhpVersion(string $raw): string
    {
        preg_match('/\d\.\d/', $raw, $matches);
        return $matches[0] ?? '8.3';
    }

    private function detectFeatures(array $deps): array
    {
        $features = [];
        if (isset($deps['laravel/horizon'])) $features[] = 'horizon';
        if (isset($deps['laravel/reverb']) || isset($deps['pusher/pusher-php-server'])) $features[] = 'websockets';
        if (isset($deps['laravel/telescope'])) $features[] = 'telescope';
        if (isset($deps['predis/predis']) || isset($deps['phpredis'])) $features[] = 'redis';
        
        return $features;
    }

    private function detectDatabase(?string $env): string
    {
        if (!$env) return 'mysql';
        if (str_contains($env, 'DB_CONNECTION=pgsql')) return 'pgsql';
        if (str_contains($env, 'DB_CONNECTION=sqlite')) return 'sqlite';
        return 'mysql';
    }

    private function detectQueue(array $deps): bool
    {
        return isset($deps['laravel/horizon']) || isset($deps['predis/predis']);
    }
}