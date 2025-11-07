<?php

namespace Src\Post\Http\Controllers;

use Illuminate\Http\Response;
use Src\Post\DTOs\ReadPostDTO;
use Src\Post\Services\ReadPostService;

class ReadPostController
{
    public function __construct(
        protected ReadPostService $readPostService
    )
    {}

    public function __invoke(int $id)
    {
        return Response::success($this->readPostService->handle(ReadPostDTO::fromArray(['id' => $id])));
    }
}
