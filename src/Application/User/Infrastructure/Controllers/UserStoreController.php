<?php

namespace Src\Application\User\Infrastructure\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Src\Application\User\Application\Store\UserStoreUseCase;
use Src\Application\User\Infrastructure\Request\UserStoreRequest;
use Src\Shared\Infrastructure\Controllers\CustomController;
use Src\Shared\Infrastructure\Helper\HttpCodesHelper;
use Src\Shared\Infrastructure\Middleware\RoleMiddleware;

final class UserStoreController extends CustomController
{
    use HttpCodesHelper;

    /**
     * @param UserStoreUseCase $userStoreUseCase
     */
    public function __construct(
        private readonly UserStoreUseCase $userStoreUseCase
    )
    {
        $this->middleware(RoleMiddleware::class, [
            'role' => 'super_admin'
        ]);
    }

    /**
     * @param UserStoreRequest $request
     * @return JsonResponse
     */
    public function __invoke(UserStoreRequest $request): JsonResponse
    {
        return $this->jsonResponse(
            $this->created(),
            false,
            $this->userStoreUseCase->__invoke($request->toArray())->entity()
        );
    }
}
