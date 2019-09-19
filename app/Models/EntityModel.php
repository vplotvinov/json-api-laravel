<?php

namespace App\Models;

use App\Models\UserModel as UserModel;

/**
 * Class Bonus
 * @package App\Models
 */
class EntityModel extends BaseModel
{
    protected $table = 'entities';
    protected $fillable = [
        'id',
        'text',
        'authorId',
        'createdAt',
        'accountId',
    ];

    protected $dates = [
        'createdAt',
        'updatedAt',
    ];

    protected $hidden = [
        'updatedAt',
    ];

    public function author()
    {
        return $this->belongsTo(UserModel::class, 'authorId');
    }

    public function account()
    {
        return $this->belongsTo(AccountModel::class, 'accountId');
    }

    public function comments()
    {
        return $this->hasMany(CommentModel::class, 'entityId');
    }
}
