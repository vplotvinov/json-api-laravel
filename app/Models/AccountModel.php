<?php

namespace App\Models;

class AccountModel extends BaseModel
{
    protected $table = 'accounts';
    protected $fillable = [
        'id',
        'title',
        'createdAt',
    ];

    protected $hidden = [
        'updatedAt',
    ];

//    public function delete()
//    {
//        $this->tokens()->delete();
//        $this->withdrawals()->delete();
//        $this->rewards()->delete();
//        $this->entityes()->delete();
//        $this->users()->delete();
//        $this->fields()->delete();
//
//        return parent::delete();
//    }

    public function tokens()
    {
        return $this->hasMany(Tokens::class, 'accountId');
    }

    public function withdrawals()
    {
        return $this->hasMany(WithdrawalModel::class, 'accountId');
    }

    public function rewards()
    {
        return $this->hasMany(RewardModel::class, 'accountId');
    }

    public function entityes()
    {
        return $this->hasMany(EntityModel::class, 'accountId');
    }

    public function users()
    {
        return $this->hasMany(UserModel::class, 'accountId');
    }

    public function fields()
    {
        return $this->hasOne(AccountFields::class, 'accountId');
    }
}
