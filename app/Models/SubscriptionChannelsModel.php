<?php

namespace App\Models;

class SubscriptionChannelsModel extends BaseModel
{
    protected $table = 'subscriptionChannels';
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
