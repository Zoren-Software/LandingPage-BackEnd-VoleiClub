<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\LogoutRequest;
use App\Models\PersonalAccessToken;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Exception;
use Illuminate\Validation\ValidationException;
use Throwable;

class SanctumController extends Controller
{
    /**
    * @param LoginRequest $request
    *
    * @group Auth Sanctum Login
    * @unauthenticated
    *
    * @return [type]
    */
    public function login(LoginRequest $request)
    {
        try {
            $user = User::where('email', $request->email)->first();

            if (!$user || !Hash::check($request->password, $user->password)) {
                throw ValidationException::withMessages([
                    'email' => [__('Sanctum.auth.failed')],
                ]);
            }

            $token = $user->createToken($request->device_name);
            $token->accessToken->type = $request->device_type; // Assumindo que você possa acessar o token dessa maneira
            $token->accessToken->save();

            return response()->json([
                'message' => __('Sanctum.auth.login'),
                'token' => $token->plainTextToken,
                'data' => $user
            ]);
        } catch (Throwable $erro) {
            return throw new Exception($erro->getMessage());
        }
    }

    /**
    * @param LogoutRequest $request
    *
    * @group Auth Sanctum Login
    *
    * @return [type]
    */
    public function logout(LogoutRequest $request)
    {
        try {
            $user = User::where('email', $request->email)->first();

            if (!$user) {
                throw ValidationException::withMessages([
                    'email' => [__('Sanctum.auth.failed')],
                ]);
            }

            $token = explode('|', $request->token);

            PersonalAccessToken::where('id', $token[0])->delete();

            return response()->json([
                'message' => __('Sanctum.auth.logout')
            ]);

        } catch (Throwable $erro) {
            return throw new Exception($erro->getMessage());
        }
    }
}
