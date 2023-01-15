<?php

namespace Src\Management\Login\Application\Login;

use Src\Management\Login\Application\Auth\LoginAuthenticationUseCase;
use Src\Management\Login\Domain\Contracts\LoginRepositoryContract;
use Src\Management\Login\Domain\Login;
use Src\Management\Login\Domain\ValueObjects\LoginAuthentication;

final class LoginAuthUseCase
{
    /**
     * @param LoginRepositoryContract $loginRepositoryContract
     * @param LoginAuthenticationUseCase $loginAuthenticationUseCase
     */
    public function __construct(
        private readonly LoginRepositoryContract $loginRepositoryContract,
        private readonly LoginAuthenticationUseCase $loginAuthenticationUseCase
    )
    {
    }

    /**
     * @param array $request
     * @return Login
     */
    public function __invoke(array $request): Login
    {
        $login = $this->loginRepositoryContract->login(new LoginAuthentication($request));
        return new Login(array_merge($login->handler(), [
            "jwt" => $this->loginAuthenticationUseCase->__invoke($login->handler())
        ]));
    }
}
