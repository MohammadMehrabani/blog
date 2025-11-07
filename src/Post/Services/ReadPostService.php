<?php

namespace Src\Post\Services;

use Illuminate\Support\Facades\Cache;
use Src\Post\Contracts\PostRepositoryContract;
use Src\Post\DTOs\ReadPostDTO;
use Src\SharedKernel\DTOs\Post\PostDTO;

class ReadPostService
{
    public function __construct(
        protected PostRepositoryContract $postRepository,
    )
    {}

    public function handle(ReadPostDTO $dto): PostDTO
    {
        $post = Cache::remember('post_'.$dto->id, 21600, function () use ($dto) { // Cache for 6h
            return $this->postRepository->findOrFail(
                where: [
                    'user_id' => request()->user()->id,
                    'id' => $dto->id
                ],
                relations: ['user']
            );
        });

        $cacheKey = 'post_viewed_' . $post->id . '_' . sha1(request()->ip());

        if (! Cache::has($cacheKey)) {

            $post->increment('views');
            $post->user->increment('total_post_views');

            Cache::put($cacheKey, true, 60 * 24); // Cache for 1d
        }

       return PostDTO::fromArray($post->toArray());
    }
}
