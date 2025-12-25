<?php

namespace App\Http\Controllers;

use App\Domains\Analyzer\LaravelProjectAnalyzer;
use App\Domains\GitHub\Services\GitHubApiService;
use Illuminate\Http\Request;

class ImportController extends Controller
{
    public function __construct(
        protected LaravelProjectAnalyzer $analyzer,
        protected GitHubApiService $githubApi
    ) {}

    public function analyzeTest()
    {
        $mockComposer = json_encode([
            'require' => [
                'php' => '^8.3',
                'laravel/framework' => '^12.0',
                'laravel/horizon' => '^5.2',
            ]
        ]);

        $analysis = $this->analyzer->analyze($mockComposer);
        
        return response()->json($analysis->toArray());
    }
}