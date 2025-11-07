<?php

namespace Src\Post\Http\Controllers;

use Illuminate\Http\Response;
use Src\Post\Http\Requests\ListPostsRequest;
use Src\Post\Services\ListPostsService;

class ListPostsController
{
    public function __construct(
        protected ListPostsService $listPostsService,
    )
    {}

    public function __invoke(ListPostsRequest $request)
    {
        return Response::success($this->listPostsService->handle($request->toDTO()));
    }
}
