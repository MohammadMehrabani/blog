<?php

namespace Src\User\Services;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Contracts\Auth\Authenticatable;
use Src\User\DTOs\UserLoginDTO;

class UserAuthenticateService
{
    /**
     * @throws AuthenticationException
     */
    public function login(UserLoginDTO $dto): array
    {
        if (! $token = auth()->attempt($dto->toArray())) {
            throw new AuthenticationException();
        }

        return $this->respondWithToken($token);
    }

    public function me(): ?Authenticatable
    {
        return auth()->user();
    }

    public function refresh(): array
    {
        return $this->respondWithToken(auth()->refresh());
    }

    public function logout(): null
    {
        return auth()->logout();
    }

    private function respondWithToken(string $token): array
    {
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ];
    }
}
