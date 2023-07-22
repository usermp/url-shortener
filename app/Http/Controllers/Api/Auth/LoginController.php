<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Constants\Constants;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Services\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        if ( ! Auth::attempt(['email' => $request->username, 'password' => $request->password]))
            return Response::unauthorized(Constants::ERROR_LOGIN);

        $user               = auth()->user();
        $user['token']      = $user->createToken('LoginToken')->accessToken;
        $user['token-type'] = "Bearer";
        return Response::success(Constants::SUCCESS_LOGIN,$user);

    }
}
