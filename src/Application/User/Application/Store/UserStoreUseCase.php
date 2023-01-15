<?php

namespace Src\Application\User\Application\Store;

use Src\Application\User\Domain\Contracts\UserRepositoryContract;
use Src\Application\User\Domain\User;
use Src\Application\User\Domain\ValueObjects\UserStore;

final class UserStoreUseCase
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
     * @return User
     */
    public function __invoke(array $request): User
    {
        return $this->userRepositoryContract->store(new UserStore($request));
    }
}
