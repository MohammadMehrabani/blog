<?php

namespace Src\User\Http\Controllers;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Src\User\Http\Requests\UserLoginRequest;
use Src\User\Services\UserAuthenticateService;

class AuthController
{
    public function __construct(
        protected UserAuthenticateService $userAuthenticateService,
    )
    {}

    /**
     * @throws AuthenticationException
     */
    public function login(UserLoginRequest $request): JsonResponse
    {
        return Response::success($this->userAuthenticateService->login($request->toDTO()));
    }

    public function me()
    {
        return Response::success($this->userAuthenticateService->me());
    }

    public function logout()
    {
        return Response::success($this->userAuthenticateService->logout());
    }

    public function refresh()
    {
        return Response::success($this->userAuthenticateService->refresh());
    }
}
