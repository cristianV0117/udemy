<?php

namespace Src\Application\User\Infrastructure\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Src\Application\Role\Infrastructure\Repositories\Eloquent\Role;
use Src\Application\State\Infrastructure\Repositories\Eloquent\State;

final class User extends Model
{
    /**
     * @var string
     */
    protected $table = "users";

    /**
     * @var string[]
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'cellphone',
        'password',
        'state_id'
    ];

    /**
     * @var string[]
     */
    protected $hidden = [
        'password'
    ];

    /**
     * @return BelongsToMany
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class,
            'users_roles',
            'user_id',
            'role_id'
        );
    }

    /**
     * @return BelongsTo
     */
    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }
}
