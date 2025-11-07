<?php

namespace Src\User\Services;

use Illuminate\Pagination\LengthAwarePaginator;
use Src\SharedKernel\DTOs\User\UserDTO;
use Src\User\Contracts\UserRepositoryContract;
use Src\User\DTOs\ListUsersDTO;
use Src\User\Models\User;

class ListUsersService
{
    public function __construct(
        protected UserRepositoryContract $userRepository,
    )
    {}

    public function handle(ListUsersDTO $dto): LengthAwarePaginator
    {
        $users = $this->userRepository->get(
            paginate: true,
            perPage: $dto->per_page,
            order: 'total_post_views'
        );

        $dtoCollection = $users->getCollection()->map(function (User $model) {
            return UserDTO::fromArray($model->toArray());
        });

        $users->setCollection($dtoCollection);

        return $users;
    }
}
