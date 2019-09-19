<?php

namespace App\Models;

class UserRoleModel extends BaseModel
{
    protected $table = 'userRoles';
    protected $fillable = [
        'id',
        'title',
    ];

    protected $hidden = [
        'updatedAt',
        'createdAt',
    ];
}
