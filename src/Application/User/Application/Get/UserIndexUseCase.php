<?php

namespace Src\Application\User\Application\Get;

use Src\Application\User\Domain\Contracts\UserRepositoryContract;
use Src\Application\User\Domain\User;

final class UserIndexUseCase
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
     * @return User
     */
    public function __invoke(): User
    {
        return $this->userRepositoryContract->index();
    }
}
