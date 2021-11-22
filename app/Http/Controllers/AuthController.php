<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Auth;
use Illuminate\Http\JsonResponse;
use JetBrains\PhpStorm\ArrayShape;

class AuthController extends Controller
{
    /**
     * @param RegisterRequest $request
     * @return JsonResponse
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        $user = User::create($request->validated());

        return new JsonResponse(['token' => $user->createToken('API Token')->plainTextToken
        ], 201);
    }

    /**
     * @param LoginRequest $request
     * @return JsonResponse|array
     */
    public function login(LoginRequest $request): JsonResponse|array
    {
        return Auth::attempt($request->validated()) ?
            [
                'token' => auth()->user()->createToken('API Token')->plainTextToken
            ] :
            response()->json([
                'error' => __('auth.failed')
            ], 401);
    }

    /**
     * @return string[]
     */
    #[ArrayShape(['message' => "string"])]
    public function logout(): array
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Token Revoked'
        ];
    }
}
