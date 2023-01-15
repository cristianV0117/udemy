<?php

namespace Src\Application\User\Infrastructure\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Src\Application\User\Application\Update\UserUpdateUseCase;
use Src\Application\User\Infrastructure\Request\UserUpdateRequest;
use Src\Shared\Infrastructure\Controllers\CustomController;
use Src\Shared\Infrastructure\Helper\HttpCodesHelper;

final class UserUpdateController extends CustomController
{
    use HttpCodesHelper;

    /**
     * @param UserUpdateUseCase $userUpdateUseCase
     */
    public function __construct(
        private readonly UserUpdateUseCase $userUpdateUseCase
    )
    {
    }

    /**
     * @param UserUpdateRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function __invoke(UserUpdateRequest $request, int $id): JsonResponse
    {
        return $this->jsonResponse(
            $this->ok(),
            false,
            $this->userUpdateUseCase->__invoke($request->toArray(), $id)->entity()
        );
    }
}
