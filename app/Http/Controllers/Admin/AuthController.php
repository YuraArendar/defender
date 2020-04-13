<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\JsonResponse;
use Laravel\Passport\Http\Controllers\AccessTokenController;
use Laravel\Passport\Token;

/**
 * Class AuthController
 * @package App\Http\Controllers\Admin
 */
class AuthController extends AccessTokenController
{
    /**
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        auth()->user()->tokens->each(function (Token $token) {
            $token->delete();
        });

        return response()->json('Logout successfully', 200);
    }
}
