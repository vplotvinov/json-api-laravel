<?php

namespace App\JsonApi\UserRoles;

use Neomerx\JsonApi\Schema\SchemaProvider;

class Schema extends SchemaProvider
{

    /**
     * @var string
     */
    protected $resourceType = 'user-roles';

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

    /**
     * @param $resource
     *      the domain record being serialized.
     *
     * @return array
     */
    public function getAttributes($resource)
    {
        return [
            'title'       => $resource->title,
            'description' => $resource->description,
            'enum'        => $resource->enum,
        ];
    }
}
