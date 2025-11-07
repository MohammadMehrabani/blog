<?php

namespace Src\User\Services;

use Illuminate\Support\Facades\Storage;
use Src\SharedKernel\DTOs\User\UserDTO;
use Src\User\Contracts\UserRepositoryContract;
use Src\User\DTOs\UpdateUserAvatarDTO;

class UpdateUserAvatarService
{
    public function __construct(
        protected UserRepositoryContract $userRepository,
    )
    {}

    public function handle(UpdateUserAvatarDTO $dto): UserDTO
    {
        $avatarPath = Storage::url($dto->avatar->store('avatars/'.request()->user()->id, 'public'));

        return UserDTO::fromArray(
            $this->userRepository->update(request()->user()->id, ['avatar_path' => $avatarPath])->toArray()
        );
    }
}
