<?php

namespace App\Policies;

use App\Models\SubscriptionsModel;
use App\Models\UserModel;
use Illuminate\Auth\Access\HandlesAuthorization;

class SubscriptionsPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the subscriptions model.
     *
     * @param UserModel          $user
     * @param SubscriptionsModel $subscriptionsModel
     *
     * @return mixed
     */
    public function view(UserModel $user, SubscriptionsModel $subscriptionsModel)
    {
        return $user->id === $subscriptionsModel->userId;
    }

    /**
     * Determine whether the user can create subscriptions models.
     *
     * @param UserModel $user
     *
     * @return mixed
     */
    public function create(UserModel $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the subscriptions model.
     *
     * @param UserModel          $user
     * @param SubscriptionsModel $subscriptionsModel
     *
     * @return mixed
     */
    public function update(UserModel $user, SubscriptionsModel $subscriptionsModel)
    {
        return $user->id === $subscriptionsModel->userId;
    }

    /**
     * Determine whether the user can delete the subscriptions model.
     *
     * @param UserModel          $user
     * @param SubscriptionsModel $subscriptionsModel
     *
     * @return mixed
     */
    public function delete(UserModel $user, SubscriptionsModel $subscriptionsModel)
    {
        return $user->id === $subscriptionsModel->userId;
    }

    /**
     * Determine whether the user can restore the subscriptions model.
     *
     * @param UserModel          $user
     * @param SubscriptionsModel $subscriptionsModel
     *
     * @return mixed
     */
    public function restore(UserModel $user, SubscriptionsModel $subscriptionsModel)
    {
        return $user->id === $subscriptionsModel->userId;
    }

    /**
     * Determine whether the user can permanently delete the subscriptions model.
     *
     * @param UserModel          $user
     * @param SubscriptionsModel $subscriptionsModel
     *
     * @return mixed
     */
    public function forceDelete(UserModel $user, SubscriptionsModel $subscriptionsModel)
    {
        return $user->id === $subscriptionsModel->userId;
    }
}
