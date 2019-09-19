<?php

namespace App\Repositories;

use App\Models\SubscriptionActionsModel;
use App\Models\SubscriptionChannelsModel;
use App\Models\SubscriptionsModel;
use Illuminate\Support\Facades\Auth;

/**
 * Class SubscriptionRepository
 * @package App\Repositories
 */
class SubscriptionRepository extends AbstractBaseRepository
{
    /**
     * @var SubscriptionsModel
     */
    protected $model;


    /**
     * Withdrawal constructor.
     *
     * @param SubscriptionsModel $model
     */
    public function __construct(SubscriptionsModel $model)
    {
        $this->model = $model;
//        $this->dto   = $dto;
    }

    /**
     * @param $data
     *
     * @return mixed
     * @throws Exception
     */
    public function create($data): array
    {
        $subscriptionAction  = SubscriptionActionsModel::whereEnum($data['action'])->firstOrFail(['id']);
        $subscriptionChannel = SubscriptionChannelsModel::whereEnum($data['channel'])->firstOrFail(['id']);

        $subscriptionData = array(
            'actionId'  => $subscriptionAction->id,
            'channelId' => $subscriptionChannel->id,
            'userId'    => Auth::user()->id,
        );

        $item = $this->model::firstOrNew($subscriptionData);
        $item->fill($subscriptionData)->save(['timestamps' => false]);

        return $item->toArray();
    }

    /**
     * @param array $data
     *
     * @return int
     * @throws Exception
     */
    public function deleteByActionAndChannel(array $data): int
    {
        $subscriptionAction  = SubscriptionActionsModel::where('enum', $data['action'])->firstOrFail(['id']);
        $subscriptionChannel = SubscriptionChannelsModel::where('enum', $data['channel'])->firstOrFail(['id']);
        $subscriptionData    = array(
            'actionId'  => $subscriptionAction->id,
            'channelId' => $subscriptionChannel->id,
            'userId'    => Auth::user()->id,
        );

        return $this->model::where($subscriptionData)->delete();
    }
}
