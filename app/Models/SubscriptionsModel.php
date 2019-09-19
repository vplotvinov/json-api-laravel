<?php

namespace App\Models;

class SubscriptionsModel extends BaseModel
{
    protected $table = 'subscriptions';
    protected $fillable = [
        'id',
        'userId',
        'actionId',
        'channelId',
        'createdAt',
    ];

    protected $hidden = [
        'updatedAt',
    ];

    public function action()
    {
        return $this->belongsTo(SubscriptionActionsModel::class, 'actionId');
    }

    public function channel()
    {
        return $this->belongsTo(SubscriptionChannelsModel::class, 'channelId');
    }
}
