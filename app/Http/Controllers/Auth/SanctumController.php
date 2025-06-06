<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\LogoutRequest;
use App\Models\PersonalAccessToken;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SanctumController extends Controller
{
    /**
     * @group Auth Sanctum Login
     *
     * @unauthenticated
     *
     * @return [type]
     */
    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => __('Sanctum.auth.failed'),
                'errors' => [
                    'password' => __('Sanctum.auth.failed'),
                ],
            ], 422);
        }

        $token = $user->createToken($request->device_name);
        $token->accessToken->type = $request->device_type; // Assumindo que você possa acessar o token dessa maneira
        $token->accessToken->save();

        return response()->json([
            'message' => __('Sanctum.auth.login'),
            'token' => $token->plainTextToken,
            'data' => $user,
        ]);
    }

    /**
     * @group Auth Sanctum Login
     *
     * @return [type]
     */
    public function logout(LogoutRequest $request)
    {
        $token = explode('|', $request->token);

        PersonalAccessToken::where('id', $token[0])->delete();

        return response()->json([
            'message' => __('Sanctum.auth.logout'),
        ]);
    }
}
