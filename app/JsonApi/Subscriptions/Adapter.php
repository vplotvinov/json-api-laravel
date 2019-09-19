<?php

namespace App\JsonApi\Subscriptions;

use App\Models\SubscriptionsModel;
use CloudCreativity\LaravelJsonApi\Eloquent\AbstractAdapter;
use CloudCreativity\LaravelJsonApi\Pagination\StandardStrategy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class Adapter extends AbstractAdapter
{

    /**
     * Mapping of JSON API attribute field names to model keys.
     *
     * @var array
     */
    protected $attributes = [];

    /**
     * Adapter constructor.
     *
     * @param StandardStrategy $paging
     */
    public function __construct(StandardStrategy $paging)
    {
        parent::__construct(new SubscriptionsModel(), $paging);
    }

    /**
     * @param Builder    $query
     * @param Collection $filters
     *
     * @return void
     */
    protected function filter($query, Collection $filters)
    {
        $currentUserId = Auth::user()->toArray()['id'];
        $query->where('id', '=', $currentUserId);
    }

}
