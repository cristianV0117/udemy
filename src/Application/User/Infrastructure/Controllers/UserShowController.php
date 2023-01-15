<?php

namespace Src\Application\User\Infrastructure\Controllers;

use Illuminate\Http\JsonResponse;
use Src\Application\User\Application\Get\UserShowUseCase;
use Src\Shared\Infrastructure\Controllers\CustomController;
use Src\Shared\Infrastructure\Helper\HttpCodesHelper;

final class UserShowController extends CustomController
{
    use HttpCodesHelper;

    /**
     * @param UserShowUseCase $userShowUseCase
     */
    public function __construct(
        private readonly UserShowUseCase $userShowUseCase
    )
    {
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function __invoke(int $id): JsonResponse
    {
        return $this->jsonResponse(
            $this->ok(),
            false,
            $this->userShowUseCase->__invoke($id)->entity()
        );
    }
}
