<?php

namespace Src\Post\DTOs;

use Src\SharedKernel\Contracts\DtoContract;

readonly class ReadPostDTO implements DtoContract
{
    public function __construct(
        public int $id
    )
    {}

    public static function fromArray(array $attributes): self
    {
        return new self(
            id: $attributes['id'],
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
        ];
    }
}
