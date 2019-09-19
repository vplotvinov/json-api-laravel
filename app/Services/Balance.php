<?php

namespace App\Services;

//use App\Repositories\Users as UserRepository;
use Exception;

class Balance
{
    protected const USER_ROLES = [
        'user'  => 1,
        'admin' => 2,
        'bot'   => 3,
    ];

    /**
     * @var UserRepository
     */
    protected $userRepo;

    /**
     * Balance constructor.
     *
     * @param UserRepository $userRepo
     */
    public function __construct()
    {
//        $this->userRepo = $userRepo;
    }
}
