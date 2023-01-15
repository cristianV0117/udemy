<?php

namespace Src\Application\User\Application\Get;

use Src\Application\User\Domain\Contracts\UserRepositoryContract;
use Src\Application\User\Domain\User;
use Src\Application\User\Domain\ValueObjects\UserId;

final class UserShowUseCase
{
    /**
     * @param UserRepositoryContract $userRepositoryContract
     */
    public function __construct(
        private readonly UserRepositoryContract $userRepositoryContract
    )
    {
    }

    /**
     * @param int $id
     * @return User
     */
    public function __invoke(int $id): User
    {
        return $this->userRepositoryContract->show(new UserId($id));
    }
}
