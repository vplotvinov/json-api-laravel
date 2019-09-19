<?php

namespace App\Http\Controllers\Api;

use App\Events\CreatedEntityName;
use App\Services\Balance;
use CloudCreativity\LaravelJsonApi\Http\Controllers\JsonApiController;
use CloudCreativity\LaravelJsonApi\Http\Requests\CreateResource;
use Exception;

class BonusesController extends JsonApiController
{
    protected $balanceService;

    public function __construct(Balance $balanceService)
    {
        $this->balanceService = $balanceService;
    }

    /**
     * @param CreateResource $request
     *
     * @throws Exception
     */
    public function creating(CreateResource $request)
    {
        $data       = $request->get('data');
        $attributes = $data['attributes'];

//        $this->balanceService;
    }

    public function created($result, CreateResource $request)
    {
        event(new CreatedEntityName($result->id));
    }
}
