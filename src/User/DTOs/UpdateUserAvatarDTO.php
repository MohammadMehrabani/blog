<?php

namespace Src\User\DTOs;

use Illuminate\Http\UploadedFile;
use Src\SharedKernel\Contracts\DtoContract;

readonly class UpdateUserAvatarDTO implements DtoContract
{
    public function __construct(
        public UploadedFile $avatar,
    )
    {}

    public static function fromArray(array $attributes): self
    {
        return new self(
            avatar: $attributes['avatar'],
        );
    }

    public function toArray(): array
    {
        return [
            'avatar' => $this->avatar,
        ];
    }
}
