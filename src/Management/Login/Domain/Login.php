<?php

namespace Src\Management\Login\Domain;

use Src\Management\Login\Domain\Exceptions\NotLoginException;
use Src\Shared\Domain\Domain;
use Src\Shared\Domain\Helper\HttpCodesDomainHelper;

final class Login extends Domain
{

    use HttpCodesDomainHelper;

    private const USER_OR_PASSWORD_INCORRECT = 'USER_OR_PASSWORD_INCORRECT';
    private const ID_ROLE_DEFAULT = 2;
    private const NAME_ROLE_DEFAULT = 'natural';
    private const ALL_ROLES_ALLOWED = '*';

    private bool $checkRole;

    public function __construct(private mixed $entity = null, private ?string $exception = null)
    {
        parent::__construct($this->entity, $this->exception);
        $this->checkRole = $this->isUserCheckRole();
    }

    /**
     * @return array
     */
    public function handler(): array
    {
        return [
            "id" => $this->entity()["id"],
            "first_name" => $this->entity()["first_name"],
            "email" => $this->entity()["email"],
            "roles" => [
                "id" => $this->entity()["roles"][0]["id"] ?? self::ID_ROLE_DEFAULT,
                "name" => $this->entity()["roles"][0]["name"] ?? self::NAME_ROLE_DEFAULT
            ]
        ];
    }

    /**
     * @param string|null $exception
     * @return void
     * @throws NotLoginException
     */
    protected function isException(?string $exception): void
    {
        if (!is_null($exception)) {
            match ($exception) {
                self::USER_OR_PASSWORD_INCORRECT => throw new NotLoginException("email or password incorrect", $this->badRequest())
            };
        }
    }

    /**
     * @return bool
     */
    private function isUserCheckRole(): bool
    {
        if (
            !array_key_exists("user", $this->entity()) &&
            !array_key_exists("typeRoles", $this->entity())
        ) {
            return true;
        }

        if (is_array($this->entity()["typeRoles"])) {
            if (!in_array($this->entity()["user"]->roles->name, $this->entity()["typeRoles"])) {
                return false;
            }

            return true;
        }

        if (self::ALL_ROLES_ALLOWED === $this->entity()["typeRoles"]) {
            return true;
        }

        if ($this->entity()["user"]->roles->name !== $this->entity()["typeRoles"]) {
            return false;
        }

        return true;
    }

    /**
     * @return bool
     */
    public function getCheckRole(): bool
    {
        return $this->checkRole;
    }
}
