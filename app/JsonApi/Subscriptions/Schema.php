<?php

namespace App\JsonApi\Subscriptions;

use Neomerx\JsonApi\Schema\SchemaProvider;

class Schema extends SchemaProvider
{

    /**
     * @var string
     */
    protected $resourceType = 'subscriptions';

    /**
     * @var array
     */
    protected $relationships = [
        'channel',
        'action',
    ];

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
            'userId'    => $resource->userId,
            'actionId'  => $resource->actionId,
            'channelId' => $resource->channelId,
            'createdAt' => $resource->createdAt,
        ];
    }

    public function getResourceLinks($resource)
    {
        return [];
    }

    public function getRelationships($resource, $isPrimary, array $includeRelationships)
    {
        return [
            'channel' => [
                self::SHOW_SELF    => false,
                self::SHOW_RELATED => false,
                self::SHOW_DATA    => isset($includeRelationships['channel']),
                self::DATA         => function () use ($resource) {
                    return $resource->channel;
                },
            ],
            'action'  => [
                self::SHOW_SELF    => false,
                self::SHOW_RELATED => false,
                self::SHOW_DATA    => isset($includeRelationships['action']),
                self::DATA         => function () use ($resource) {
                    return $resource->action;
                },
            ],
        ];
    }
}
