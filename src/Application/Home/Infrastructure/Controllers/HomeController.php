<?php

namespace Src\Application\Home\Infrastructure\Controllers;

use Illuminate\Http\JsonResponse;
use Src\Shared\Infrastructure\Controllers\CustomController;
use Src\Shared\Infrastructure\Helper\HttpCodesHelper;

final class HomeController extends CustomController
{
    use HttpCodesHelper;

    /**
     * @return JsonResponse
     */
    public function __invoke(): JsonResponse
    {
        return $this->jsonResponse(
            $this->ok(),
            false,
            [
                "udemy" => "curso de udemy",
                "home" => "Bienvenido",
                "version" => env('APP_VERSION')
            ]
        );
    }
}
