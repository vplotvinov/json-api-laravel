<?php

namespace App\JsonApi\Entity;

use App\Models\EntityModel;
use App\Scopes\AccountScope;
use CloudCreativity\LaravelJsonApi\Eloquent\AbstractAdapter;
use CloudCreativity\LaravelJsonApi\Eloquent\HasMany;
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

    protected $dates = [
        'createdAt',
    ];

    /**
     * Adapter constructor.
     *
     * @param StandardStrategy $paging
     */
    public function __construct(StandardStrategy $paging)
    {
        parent::__construct(new EntityModel(), $paging);
        $this->addScopes(new AccountScope());
    }

    /**
     * @param Builder    $query
     * @param Collection $filters
     *
     * @return void
     */
    protected function filter($query, Collection $filters)
    {
    }

    /**
     * @return HasMany
     */
    protected function comments()
    {
        return $this->hasMany();
    }

    protected function creating(EntityModel $entity)
    {
        $currentUser       = Auth::user()->toArray();
        $entity->accountId = $currentUser['accountId'];

        return $entity;
    }

    protected function created(EntityModel $entity, $resource): void
    {
        foreach ($resource->recipientIds as $recipient) {
            $entity->recipientIds()->create([
                'entityId' => $resource->id,
                'userId'  => $recipient['id'],
            ]);
        }
    }
}
