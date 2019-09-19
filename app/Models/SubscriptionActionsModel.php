<?php

namespace App\Models;

class SubscriptionActionsModel extends BaseModel
{
    protected $table = 'subscriptionActions';
    protected $fillable = [
        'id',
        'title',
        'enum',
    ];

    protected $hidden = [
        'updatedAt',
        'createdAt',
    ];
}
