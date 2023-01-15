<?php

namespace Src\Application\User\Infrastructure\Controllers;

use Illuminate\Http\JsonResponse;
use Src\Application\User\Application\Destroy\UserDestroyUseCase;
use Src\Shared\Infrastructure\Controllers\CustomController;
use Src\Shared\Infrastructure\Helper\HttpCodesHelper;

final class UserDestroyController extends CustomController
{
    use HttpCodesHelper;

    /**
     * @param UserDestroyUseCase $userDestroyUseCase
     */
    public function __construct(
        private readonly UserDestroyUseCase $userDestroyUseCase
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
            $this->userDestroyUseCase->__invoke($id)->entity()
        );
    }
}
