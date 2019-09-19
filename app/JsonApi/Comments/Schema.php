<?php

namespace App\JsonApi\Comments;

use Neomerx\JsonApi\Schema\SchemaProvider;

class Schema extends SchemaProvider
{

    /**
     * @var string
     */
    protected $resourceType = 'comments';

    /**
     * @var array
     */
    protected $relationships = [
        'author',
        'author.role',
    ];

    /**
     * @var array
     */
    protected $attributes = [
        'text',
        'entityId',
        'authorId',
    ];

    public function getResourceLinks($resource)
    {
        return [];
    }

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
            'authorId'  => $resource->authorId,
            'entityId'   => $resource->entityId,
            'text'      => $resource->text,
            'createdAt' => $resource->createdAt,
        ];
    }

    public function getRelationships($resource, $isPrimary, array $includeRelationships)
    {
        return [
            'author' => [
                self::SHOW_SELF    => false,
                self::SHOW_RELATED => false,
                self::SHOW_DATA    => isset($includeRelationships['author']),
                self::DATA         => function () use ($resource) {
                    return $resource->author;
                },
            ],
        ];
    }
}
