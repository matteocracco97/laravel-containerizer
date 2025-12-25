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


    public function index(Request $request)
    {
        try {
            $query = $request->get('q');
            $page = $request->get('page', 1);
            $perPage = 6; // Show 6 repos per page

            $repos = $this->githubApi->getUserRepositories(
                auth()->user()->github_token,
                $query,
                $page,
                $perPage
            );

            return view('dashboard', compact('repos', 'query', 'page'));
        } catch (\Exception $e) {
            auth()->logout();
            return redirect()->route('login')->with('error', 'GitHub session expired.');
        }
    }

    public function getRepos(Request $request)
    {
        try {
            $query = $request->get('q');
            $page = $request->get('page', 1);
            $perPage = 6;

            $repos = $this->githubApi->getUserRepositories(
                auth()->user()->github_token,
                $query,
                $page,
                $perPage
            );

            return response()->json([
                'repos' => $repos,
                'hasMore' => count($repos) >= 6,
                'page' => $page
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch repositories'], 500);
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