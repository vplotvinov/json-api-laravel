<?php

namespace App\Services\Registration;


use App\Models\AccountModel;

class AccountRegistrationService
{
    /**
     * @param array $accountData
     *
     * @return array
     */
    public function registerAccount(array $accountData): array
    {
        /** TODO: Move logic to Repository */
        $accountFieldsData = [
            'description' => 'website account',
        ];
        $accountData       = AccountModel::create($accountData)->fields()->create($accountFieldsData);

        return $accountData->toArray();
    }
}
