<?php

namespace Src\SharedKernel\DTOs\Post;

use Src\SharedKernel\Contracts\DtoContract;
use Src\SharedKernel\DTOs\User\UserDTO;

readonly class PostDTO implements DtoContract
{
    public function __construct(
        public int $id,
        public string $title,
        public string $body,
        public int $views,
        public int $user_id,
        public UserDTO $user,
        public string $created_at,
        public string $updated_at,
    )
    {}

    public static function fromArray(array $attributes): self
    {
        return new self(
            id: $attributes['id'],
            title: $attributes['title'],
            body: $attributes['body'],
            views: $attributes['views'],
            user_id: $attributes['user_id'],
            user: UserDTO::fromArray($attributes['user']),
            created_at: $attributes['created_at'],
            updated_at: $attributes['updated_at'],
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'body' => $this->body,
            'views' => $this->views,
            'user_id' => $this->user_id,
            'user' => $this->user,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
