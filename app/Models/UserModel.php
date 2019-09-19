<?php

namespace App\Models;

use App\Models\WithdrawalModel as WithdrawalModel;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class UserModel extends Authenticatable
{
    use Notifiable, HasApiTokens;

    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'updatedAt';
    public static $snakeAttributes = false;
    public $timestamps = false;
    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'accountId',
        'firstName',
        'lastName',
        'avatarUrl',
        'password',
        'userStatusId',
        'userRoleId',
        'outgoingPoints',
        'budgetPoints',
        'dateOfBirth',
        'hiredAt',
        'lastLoginAt',
    ];

    protected $dates = [
        'createdAt',
        'updatedAt',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'updatedAt',
    ];

    public function account()
    {
        return $this->belongsTo(AccountModel::class, 'accountId');
    }

    public function role()
    {
        return $this->belongsTo(UserRoleModel::class, 'userRoleId');
    }

    public function entities()
    {
        return $this->hasMany(EntityModel::class, 'userId');
    }

    public function subscriptions()
    {
        return $this->hasMany(SubscriptionsModel::class, 'userId');
    }

    public function isAdmin(): bool
    {
        return $this->userRoleId === config('constants.userRoles.admin');
    }
}
