<?php

namespace Src\Management\Login\Infrastructure\Repositories\FirebaseJwt;

use Exception;
use Src\Management\Login\Domain\Contracts\LoginAuthenticationContract;
use Src\Management\Login\Domain\ValueObjects\LoginAuthenticationParameters;
use Firebase\JWT\JWT;
use Src\Management\Login\Domain\ValueObjects\LoginJwt;

final class LoginAuthentication implements LoginAuthenticationContract
{
    /**
     * @var JWT
     */
    private JWT $jwt;

    public function __construct()
    {
        $this->jwt = new JWT();
    }

    /**
     * @param LoginAuthenticationParameters $loginAuthentication
     * @return string
     */
    public function auth(LoginAuthenticationParameters $loginAuthentication): string
    {
        return $this->jwt::encode(
            [
                $loginAuthentication->handler()
            ],
            $loginAuthentication->jwtKey()
        );
    }

    /**
     * @param LoginJwt $loginJwt
     * @return bool
     */
    public function check(LoginJwt $loginJwt): bool
    {
        try {
            $decode = $this->jwt::decode(
                $loginJwt->value(),
                $loginJwt->jwtKey(),
                $loginJwt->jwtEncrypt()
            );
            if (time() > $decode[0]->exp) {
                return false;
            }
        } catch (Exception) {
            return false;
        }

        return true;
    }

    /**
     * @param LoginJwt $loginJwt
     * @return mixed
     */
    public function get(LoginJwt $loginJwt): mixed
    {
        return $this->jwt::decode(
            $loginJwt->value(),
            $loginJwt->jwtKey(),
            $loginJwt->jwtEncrypt()
        )[0]->data;
    }
}
