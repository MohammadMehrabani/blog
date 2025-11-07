<?php

namespace Src\User\DTOs;

use Src\SharedKernel\Contracts\DtoContract;

readonly class ListUsersDTO implements DtoContract
{
    public function __construct(
        public int $per_page = 15,
        // can add other filter attributes
    )
    {}

    public static function fromArray(array $attributes): self
    {
        return new self(
            per_page: $attributes['per_page'] ?? 15,
        );
    }

    public function toArray(): array
    {
        return [
            'per_page' => $this->per_page,
        ];
    }
}
