<?php

namespace Src\Post\Services;

use Illuminate\Pagination\LengthAwarePaginator;
use Src\Post\Contracts\PostRepositoryContract;
use Src\Post\DTOs\ListPostsDTO;
use Src\Post\Models\Post;
use Src\SharedKernel\DTOs\Post\PostDTO;

class ListPostsService
{
    public function __construct(
        protected PostRepositoryContract $postRepository,
    )
    {}

    public function handle(ListPostsDTO $dto): LengthAwarePaginator
    {
        $posts = $this->postRepository->get(
            where: ['user_id' => request()->user()->id],
            relations: ['user'],
            paginate: true,
            perPage: $dto->per_page
        );

        $dtoCollection = $posts->getCollection()->map(function (Post $model) {
            return PostDTO::fromArray($model->toArray());
        });

        $posts->setCollection($dtoCollection);

        return $posts;
    }
}
