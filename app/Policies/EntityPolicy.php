<?php

namespace App\Policies;

use App\Models\EntityModel;
use App\Models\UserModel;
use Illuminate\Auth\Access\HandlesAuthorization;

class EntityPolicy
{
    use HandlesAuthorization;


    public function before(UserModel $user, $ability)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can view the entity model.
     *
     * @param UserModel   $user
     * @param EntityModel $entityModel
     *
     * @return mixed
     */
    public function view(UserModel $user, EntityModel $entityModel)
    {
        return true;
    }

    /**
     * Determine whether the user can create entity models.
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
     * Determine whether the user can update the entity model.
     *
     * @param UserModel   $user
     * @param EntityModel $entityModel
     *
     * @return mixed
     */
    public function update(UserModel $user, EntityModel $entityModel)
    {
        return $user->id === $entityModel->authoId;
    }

    /**
     * Determine whether the user can delete the entity model.
     *
     * @param UserModel   $user
     * @param EntityModel $entityModel
     *
     * @return mixed
     */
    public function delete(UserModel $user, EntityModel $entityModel)
    {
        return $user->id === $entityModel->authorId;
    }

    /**
     * Determine whether the user can restore the entity model.
     *
     * @param UserModel   $user
     * @param EntityModel $entityModel
     *
     * @return mixed
     */
    public function restore(UserModel $user, EntityModel $entityModel)
    {
        return $user->id === $entityModel->authorId;
    }

    /**
     * Determine whether the user can permanently delete the entity model.
     *
     * @param UserModel   $user
     * @param EntityModel $entityModel
     *
     * @return mixed
     */
    public function forceDelete(UserModel $user, EntityModel $entityModel)
    {
        return $user->id === $entityModel->authorId;
    }
}
