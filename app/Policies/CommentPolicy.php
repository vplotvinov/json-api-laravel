<?php

namespace App\Policies;

use App\Models\CommentModel;
use App\Models\UserModel;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    public function before(UserModel $user, $ability)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can view the comment model.
     *
     * @param UserModel    $user
     * @param CommentModel $commentModel
     *
     * @return mixed
     */
    public function view(UserModel $user, CommentModel $commentModel)
    {
        return true;
    }

    /**
     * Determine whether the user can create comment models.
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
     * Determine whether the user can update the comment model.
     *
     * @param UserModel    $user
     * @param CommentModel $commentModel
     *
     * @return mixed
     */
    public function update(UserModel $user, CommentModel $commentModel)
    {
        return $user->id === $commentModel->authorId;
    }

    /**
     * Determine whether the user can delete the comment model.
     *
     * @param UserModel    $user
     * @param CommentModel $commentModel
     *
     * @return mixed
     */
    public function delete(UserModel $user, CommentModel $commentModel)
    {
        return $user->id === $commentModel->authorId;
    }

    /**
     * Determine whether the user can restore the comment model.
     *
     * @param UserModel    $user
     * @param CommentModel $commentModel
     *
     * @return mixed
     */
    public function restore(UserModel $user, CommentModel $commentModel)
    {
        return $user->id === $commentModel->authorId;
    }

    /**
     * Determine whether the user can permanently delete the comment model.
     *
     * @param UserModel    $user
     * @param CommentModel $commentModel
     *
     * @return mixed
     */
    public function forceDelete(UserModel $user, CommentModel $commentModel)
    {
        return $user->id === $commentModel->authorId;
    }
}
