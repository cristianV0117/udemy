<?php

namespace Src\Management\Login\Domain\ValueObjects;

use Src\Shared\Domain\ValueObjects\MixedValueObject;

final class LoginAuthentication extends MixedValueObject
{
    /**
     * @param string $passwordRequest
     * @param string $password
     * @return bool
     */
    public function checkPassword(string $passwordRequest, string $password): bool
    {
        return password_verify($passwordRequest, $password);
    }
}
