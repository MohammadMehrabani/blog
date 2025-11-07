<?php

namespace Src\SharedKernel\DTOs\User;

use Src\SharedKernel\Contracts\DtoContract;

readonly class UserDTO implements DtoContract
{
    public function __construct(
        public int $id,
        public string $firstname,
        public string $lastname,
        public ?string $avatar_path = null,
        public string $mobile,
        public ?string $mobile_verified_at = null,
        public int $total_post_views,
        public string $created_at,
        public string $updated_at,
    )
    {}

    public static function fromArray(array $attributes): self
    {
        return new self(
            id: $attributes['id'],
            firstname: $attributes['firstname'],
            lastname: $attributes['lastname'],
            avatar_path: $attributes['avatar_path'],
            mobile: $attributes['mobile'],
            mobile_verified_at: $attributes['mobile_verified_at'],
            total_post_views: $attributes['total_post_views'],
            created_at: $attributes['created_at'],
            updated_at: $attributes['updated_at'],
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'avatar_path' => $this->avatar_path,
            'mobile' => $this->mobile,
            'mobile_verified_at' => $this->mobile_verified_at,
            'total_post_views' => $this->total_post_views,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
