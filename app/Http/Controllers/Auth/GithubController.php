<?php

namespace App\Http\Controllers\Auth;

use App\Domains\User\Repositories\UserRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GithubController extends Controller
{
    public function __construct(
        private UserRepositoryInterface $userRepository
    ) {}

    public function redirect()
    {
        return Socialite::driver('github')
            ->scopes(['repo', 'read:user'])
            ->redirect();
    }

    public function callback()
    {
        $githubUser = Socialite::driver('github')->user();

        $user = $this->userRepository->updateOrCreateByGithubId($githubUser->id, [
            'name' => $githubUser->getName() ?? $githubUser->getNickname(),
            'email' => $githubUser->getEmail(),
            'github_token' => $githubUser->token,
            'github_refresh_token' => $githubUser->refreshToken,
            'avatar' => $githubUser->getAvatar(),
        ]);

        Auth::login($user);

        return redirect()->route('dashboard');
    }
}