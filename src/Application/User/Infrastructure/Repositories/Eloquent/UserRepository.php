<?php

namespace Src\Application\User\Infrastructure\Repositories\Eloquent;

use Src\Application\User\Domain\Contracts\UserRepositoryContract;
use Src\Application\User\Domain\User;
use Src\Application\User\Domain\ValueObjects\UserId;
use Src\Application\User\Domain\ValueObjects\UserStore;
use Src\Application\User\Domain\ValueObjects\UserUpdate;
use Src\Application\User\Infrastructure\Repositories\Eloquent\User as Model;

final class UserRepository implements UserRepositoryContract
{
    /**
     * @var \Src\Application\User\Infrastructure\Repositories\Eloquent\User
     */
    private Model $model;

    public function __construct()
    {
        $this->model = new Model();
    }

    /**
     * @return User
     */
    public function index(): User
    {
        $index = $this->model->with('state')->get();

        return new User($index->toArray());
    }

    /**
     * @param UserId $userId
     * @return User
     */
    public function show(UserId $userId): User
    {
        $user = $this->model->where('id', $userId->value())->get();

        if (empty($user->toArray())) {
            return new User(null, 'USER_NOT_FOUND');
        }

        return new User($user->toArray());
    }

    /**
     * @param UserStore $userStore
     * @return User
     */
    public function store(UserStore $userStore): User
    {
        $store = $this->model->create($userStore->handler());

        if (!$store) {
            return new User(null, 'USER_STORE_FAILED');
        }

        return new User($store->toArray());
    }

    /**
     * @param UserUpdate $userUpdate
     * @param UserId $userId
     * @return User
     */
    public function update(UserUpdate $userUpdate, UserId $userId): User
    {
        $record = $this->model->find($userId->value());

        if (is_null($record)) {
            return new User(null, 'USER_NOT_FOUND');
        }

        $record->update($userUpdate->handler());

        return new User($record->toArray());
    }

    /**
     * @param UserId $userId
     * @return User
     */
    public function destroy(UserId $userId): User
    {
        $record = $this->model->find($userId->value());

        if (is_null($record)) {
            return new User(null, 'USER_NOT_FOUND');
        }

        $record->delete();

        return new User($record->id);
    }
}
