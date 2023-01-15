<?php

namespace Src\Application\Home\Infrastructure\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Exception;
use Src\Application\Home\Exceptions\StatusException;
use Src\Shared\Infrastructure\Controllers\CustomController;
use Src\Shared\Infrastructure\Helper\HttpCodesHelper;

final class StatusController extends CustomController
{
    private DB $DB;

    use HttpCodesHelper;

    public function __construct()
    {
        $this->DB = new DB;
    }

    /**
     * @return JsonResponse
     * @throws StatusException
     */
    public function __invoke(): JsonResponse
    {
        try {
            $this->connection();
            return $this->jsonResponse(
                $this->ok(),
                false,
                "OK"
            );
        } catch (\Exception) {
            throw new StatusException("NOT OK", $this->notService());
        }
    }

    /**
     * @return void
     */
    private function connection(): void
    {
        $this->DB::connection()->getPdo();
    }
}
