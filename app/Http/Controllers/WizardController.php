<?php

namespace App\Http\Controllers;

use App\Domains\Analyzer\LaravelProjectAnalyzer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WizardController extends Controller
{
    public function __construct(
        protected LaravelProjectAnalyzer $analyzer
    ) {}


    public function index()
    {
        $response = Http::withToken(auth()->user()->github_token)
            ->get('https://api.github.com/user/repos', [
                'sort' => 'updated',
                'per_page' => 30,
            ]);

        $repos = $response->json();

        if ($response->failed()) {
            auth()->logout();
            return redirect()->route('login')->with('error', 'Github session expired.');
        }

        return view('dashboard', compact('repos'));
    }

    /***
     * Analyze a specific repository
     */
    public function analyze($owner, $repo)
    {
        // 1. Fetch of composer.json via GitHub API
        $response = Http::withToken(auth()->user()->github_token)
            ->get("https://api.github.com/repos/{$owner}/{$repo}/contents/composer.json");

        if ($response->failed()) {
            return back()->with('error', 'This is not a valid Laravel project (composer.json is missing)');
        }

        $composerJson = base64_decode($response->json('content'));

        $analysis = $this->analyzer->analyze($composerJson);
        
        return view('wizard', [
            'repo' => "{$owner}/{$repo}",
            'analysis' => $analysis
        ]);
    }
}