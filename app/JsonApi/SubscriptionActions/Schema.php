<?php

namespace App\JsonApi\SubscriptionActions;

use Neomerx\JsonApi\Schema\SchemaProvider;

class Schema extends SchemaProvider
{

    /**
     * @var string
     */
    protected $resourceType = 'subscription-actions';

    /**
     * @param $resource
     *      the domain record being serialized.
     *
     * @return string
     */
    public function getId($resource): string
    {
        return $resource->getRouteKey();
    }

    public function getResourceLinks($resource)
    {
        return [];
    }

    /**
     * @param $resource
     *      the domain record being serialized.
     *
     * @return array
     */
    public function getAttributes($resource)
    {
        return [
            'title'     => $resource->title,
            'enum'      => $resource->enum,
            'createdAt' => $resource->createdAt,
        ];
    }
}
