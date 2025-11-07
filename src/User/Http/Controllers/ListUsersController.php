<?php

namespace Src\User\Http\Controllers;

use Illuminate\Http\Response;
use Src\User\Http\Requests\ListUsersRequest;
use Src\User\Services\ListUsersService;

class ListUsersController
{
    public function __construct(
        protected ListUsersService $listUsersService,
    )
    {}

    public function __invoke(ListUsersRequest $request)
    {
        return Response::success($this->listUsersService->handle($request->toDTO()));
    }
}
