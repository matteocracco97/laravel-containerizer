<?php

namespace App\Http\Controllers;

use App\Domains\Analyzer\LaravelProjectAnalyzer;
use App\Domains\GitHub\Services\GitHubApiService;
use Illuminate\Http\Request;

class WizardController extends Controller
{
    public function __construct(
        protected LaravelProjectAnalyzer $analyzer,
        protected GitHubApiService $githubApi
    ) {}


    public function index()
    {
        try {
            $repos = $this->githubApi->getUserRepositories(auth()->user()->github_token);
            return view('dashboard', compact('repos'));
        } catch (\Exception $e) {
            auth()->logout();
            return redirect()->route('login')->with('error', 'GitHub session expired.');
        }
    }

    /**
     * Analyze a specific repository
     */
    public function analyze($owner, $repo)
    {
        try {
            $composerJson = $this->githubApi->getComposerJson(auth()->user()->github_token, $owner, $repo);
            $analysis = $this->analyzer->analyze($composerJson);

            return view('wizard', [
                'repo' => "{$owner}/{$repo}",
                'analysis' => $analysis
            ]);
        } catch (\Exception $e) {
            return back()->with('error', 'This is not a valid Laravel project (composer.json is missing or inaccessible)');
        }
    }
}