<?php

namespace Src\Management\Login\Infrastructure\Repositories\Eloquent;

use Src\Management\Login\Infrastructure\Repositories\Eloquent\User as Model;
use Src\Management\Login\Domain\Contracts\LoginRepositoryContract;
use Src\Management\Login\Domain\Login;
use Src\Management\Login\Domain\ValueObjects\LoginAuthentication;

final class LoginRepository implements LoginRepositoryContract
{
    /**
     * @var User
     */
    private Model $model;

    /**
     * @param User $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @param LoginAuthentication $loginAuthentication
     * @return Login
     */
    public function login(LoginAuthentication $loginAuthentication): Login
    {
        $user = $this->userByEmail($loginAuthentication->value()["email"]);

        if (!$user) {
            return new Login(null, 'USER_OR_PASSWORD_INCORRECT');
        }

        $check = $loginAuthentication->checkPassword($loginAuthentication->value()["password"], $user["password"]);

        if (!$check) {
            return new Login(null, 'USER_OR_PASSWORD_INCORRECT');
        }

        return new Login($user);
    }

    /**
     * @param string $email
     * @return array|null
     */
    private function userByEmail(
        string $email
    ): ?array
    {
        $user = $this->model
            ->with('roles')
            ->where('email', '=', $email)
            ->select(
                'id',
                'first_name',
                'email',
                'password'
            )
            ->first();
        return $user?->makeVisible('password')->toArray();
    }
}
