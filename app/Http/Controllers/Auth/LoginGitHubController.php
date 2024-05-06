<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\GitHubService;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class LoginGitHubController extends Controller
{
    /**
     * @codeCoverageIgnore
     *
     * @return Socialite
     */
    public function githubRedirect()
    {
        return Socialite::driver('github')
            ->redirect();
    }

    /**
     * @codeCoverageIgnore
     *
     * @return redirect
     */
    public function githubCallback()
    {
        $githubUser = Socialite::driver('github')->user();

        $githubService = new GitHubService();

        $login = $githubService->verifyPermissionUser($githubUser->getNickname());

        if (! $login) {
            return redirect()->route('welcome-vapor-ui', ['error' => 'Você não tem permissão para acessar o VaporUI']);
        }

        $user = User::updateOrCreate(
            ['github_id' => $githubUser->getId()],
            [
                'name' => $githubUser->getName(),
                'email' => $githubUser->getEmail(),
                'github_id' => $githubUser->getId(),
                'auth_type' => 'github',
                'password' => Hash::make($githubUser->getId()),
            ]
        );

        auth()->guard('web')->login($user);

        return redirect()->route('welcome-vapor-ui');
    }

    /**
     * @codeCoverageIgnore
     *
     * @return redirect
     */
    public function logout()
    {
        auth()->guard('web')->logout();

        return redirect()->route('welcome-vapor-ui');
    }
}
