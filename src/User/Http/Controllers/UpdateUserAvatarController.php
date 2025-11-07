<?php

namespace Src\User\Http\Controllers;

use Illuminate\Http\Response;
use Src\User\Http\Requests\UpdateUserAvatarRequest;
use Src\User\Services\UpdateUserAvatarService;

class UpdateUserAvatarController
{
    public function __construct(
        protected UpdateUserAvatarService $updateUserAvatarService
    )
    {}

    public function __invoke(UpdateUserAvatarRequest $request)
    {
        return Response::success($this->updateUserAvatarService->handle($request->toDTO()));
    }
}
