<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\v3\LoginRequest;
use App\Http\Requests\v3\LogoutRequest;
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
                    'email' => [__('auth.failed')],
                ]);
            }

            $token = $user->createToken($request->deviceName, ['type' => $request->deviceType]);
            $token->accessToken->type = $request->deviceType; // Assumindo que você possa acessar o token dessa maneira
            $token->accessToken->save();

            return response()->json([
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
            // TODO - Implementar a lógica de logout
        } catch (Throwable $erro) {
            return throw new Exception($erro->getMessage());
        }
    }
}
