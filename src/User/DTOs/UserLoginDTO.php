<?php

namespace Src\User\DTOs;

use Src\SharedKernel\Contracts\DtoContract;

readonly class UserLoginDTO implements DtoContract
{
    public function __construct(
        public string $mobile,
        public string $password,
    )
    {}

    public static function fromArray(array $attributes): self
    {
        return new self(
            mobile: $attributes['mobile'],
            password: $attributes['password'],
        );
    }

    public function toArray(): array
    {
        return [
            'mobile' => $this->mobile,
            'password' => $this->password,
        ];
    }
}
