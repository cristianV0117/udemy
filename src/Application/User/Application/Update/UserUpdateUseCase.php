<?php

namespace Src\Application\User\Application\Update;

use Src\Application\User\Domain\Contracts\UserRepositoryContract;
use Src\Application\User\Domain\User;
use Src\Application\User\Domain\ValueObjects\UserId;
use Src\Application\User\Domain\ValueObjects\UserUpdate;

final class UserUpdateUseCase
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
     * @param array $request
     * @param int $id
     * @return User
     */
    public function __invoke(array $request, int $id): User
    {
        return $this->userRepositoryContract->update(new UserUpdate($request), new UserId($id));
    }
}
