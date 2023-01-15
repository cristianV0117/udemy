<?php

namespace Src\Management\Login\Domain\Contracts;

use Src\Management\Login\Domain\ValueObjects\LoginAuthenticationParameters;
use Src\Management\Login\Domain\ValueObjects\LoginJwt;

interface LoginAuthenticationContract
{
    /**
     * @param LoginAuthenticationParameters $loginAuthentication
     * @return string
     */
    public function auth(LoginAuthenticationParameters $loginAuthentication): string;

    /**
     * @param LoginJwt $loginJwt
     * @return bool
     */
    public function check(LoginJwt $loginJwt): bool;

    /**
     * @param LoginJwt $loginJwt
     * @return mixed
     */
    public function get(LoginJwt $loginJwt): mixed;
}
