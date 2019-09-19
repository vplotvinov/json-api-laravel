<?php

namespace App\Services;

use App\Repositories\SubscriptionRepository;
use Exception;

/**
 * TODO: Move on JSON-API standart
 */
/**
 * Class SubscriptionService
 * @package App\Services
 */
class SubscriptionService
{
    /**
     * @var SubscriptionRepository
     */
    protected $repo;

    /**
     * Subscription constructor.
     *
     * @param SubscriptionRepository $repo
     *
     */
    public function __construct(
        SubscriptionRepository $repo
    ) {
        $this->repo = $repo;
    }

    /**
     * @param array $data
     *
     * @return array
     * @throws Exception
     */
    public function create(array $data): array
    {
        $subscriptionDto = $this->repo->create($data);

        return $subscriptionDto;
    }

    /**
     * @param array $data
     *
     * @return int
     * @throws Exception
     */
    public function delete(array $data): int
    {
        return $this->repo->deleteByActionAndChannel($data);
    }
}
