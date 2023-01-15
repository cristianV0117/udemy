<?php

namespace Src\Management\Login\Infrastructure\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Src\Management\Login\Application\Login\LoginAuthUseCase;
use Src\Shared\Infrastructure\Controllers\CustomController;
use Src\Shared\Infrastructure\Helper\HttpCodesHelper;

final class LoginAuthController extends CustomController
{
    use HttpCodesHelper;

    /**
     * @param LoginAuthUseCase $loginAuthUseCase
     */
    public function __construct(private LoginAuthUseCase $loginAuthUseCase)
    {
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        return $this->jsonResponse(
            $this->ok(),
            false,
            $this->loginAuthUseCase->__invoke($request->toArray())->entity()
        );
    }
}
