<?php

namespace App\Services\Registration;

use App\Models\UserModel;

class UserRegistrationService
{
    /**
     * @param array $data
     *
     * @return array
     */
    public function registerUser(array $data): array
    {
        /** TODO: Move logic to Repository */
        $user = UserModel::create($data);

        return $user->toArray();
    }
}
