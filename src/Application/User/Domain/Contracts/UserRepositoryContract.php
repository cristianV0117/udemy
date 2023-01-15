<?php

namespace Src\Application\User\Domain\Contracts;

use Src\Application\User\Domain\User;
use Src\Application\User\Domain\ValueObjects\UserId;
use Src\Application\User\Domain\ValueObjects\UserStore;
use Src\Application\User\Domain\ValueObjects\UserUpdate;

interface UserRepositoryContract
{
    /**
     * @return User
     */
    public function index(): User;

    /**
     * @param UserId $userId
     * @return User
     */
    public function show(UserId $userId): User;

    /**
     * @param UserStore $userStore
     * @return User
     */
    public function store(UserStore $userStore): User;

    /**
     * @param UserUpdate $userUpdate
     * @param UserId $userId
     * @return User
     */
    public function update(UserUpdate $userUpdate, UserId $userId): User;

    /**
     * @param UserId $userId
     * @return User
     */
    public function destroy(UserId $userId): User;
}
