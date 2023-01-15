<?php

namespace Src\Management\Login\Application\Auth;

use Src\Management\Login\Domain\Contracts\LoginAuthenticationContract;
use Src\Management\Login\Domain\ValueObjects\LoginJwt;

final class LoginCheckAuthenticationUseCase
{
    /**
     * @param LoginAuthenticationContract $loginAuthenticationContract
     */
    public function __construct(
        private readonly LoginAuthenticationContract $loginAuthenticationContract
    )
    {
    }

    /**
     * @param string $jwt
     * @return bool
     */
    public function __invoke(string $jwt)
    {
        return $this->loginAuthenticationContract->check(new LoginJwt($jwt));
    }
}
