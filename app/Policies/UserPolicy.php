<?php

namespace App\Policies;

use App\Models\UserModel;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;


    public function before(UserModel $user, $ability)
    {
        if ($user->isAdmin()) {
            return true;
        }
    }

    /**
     *
     * Determine whether the user can view the user model.
     *
     * @param UserModel $user
     * @param UserModel $userModel
     *
     * @return mixed
     */
    public function view(UserModel $user, UserModel $userModel)
    {
        return true;
    }

    /**
     * Determine whether the user can create user models.
     *
     * @param UserModel $user
     *
     * @return mixed
     */
    public function create(UserModel $user)
    {
        return false;
    }

    /**
     * Determine whether the user can update the user model.
     *
     * @param UserModel $user
     * @param UserModel $userModel
     *
     * @return mixed
     */
    public function update(UserModel $user, UserModel $userModel)
    {
        return $user->id === $userModel->id;
    }

    /**
     * Determine whether the user can delete the user model.
     *
     * @param UserModel $user
     * @param UserModel $userModel
     *
     * @return mixed
     */
    public function delete(UserModel $user, UserModel $userModel)
    {
        return $user->id === $userModel->id;
    }

    /**
     * Determine whether the user can restore the user model.
     *
     * @param UserModel $user
     * @param UserModel $userModel
     *
     * @return mixed
     */
    public function restore(UserModel $user, UserModel $userModel)
    {
        return $user->id === $userModel->id;
    }

    /**
     * Determine whether the user can permanently delete the user model.
     *
     * @param UserModel $user
     * @param UserModel $userModel
     *
     * @return mixed
     */
    public function forceDelete(UserModel $user, UserModel $userModel)
    {
        return $user->id === $userModel->id;
    }
}
