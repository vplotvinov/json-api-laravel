<?php

namespace App\JsonApi\Entity;

use Neomerx\JsonApi\Schema\SchemaProvider;

class Schema extends SchemaProvider
{
    /**
     * @var string
     */
    protected $resourceType = 'entityes';

    /**
     * @var array
     */
    protected $attributes = [
        'text',
        'amount',
        'authorId',
        'createdAt',
    ];

    /**
     * @var array
     */
    protected $relationships = [
        'author',
        'author.role',
        'comments',
        'comments.author',
        'comments.author.role',
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
            'text'      => $resource->text,
            'amount'    => $resource->amount,
            'authorId'  => $resource->authorId,
            'accountId' => $resource->accountId,
            'createdAt' => $resource->createdAt,
        ];
    }

    public function getResourceLinks($resource)
    {
        return [];
    }

    /**
     * @param object $resource
     * @param bool   $isPrimary
     * @param array  $includeRelationships
     *
     * @return array
     */
    public function getRelationships($resource, $isPrimary, array $includeRelationships)
    {
        return [
            'author'       => [
                self::SHOW_SELF    => false,
                self::SHOW_RELATED => false,
                self::SHOW_DATA    => isset($includeRelationships['author']),
                self::DATA         => function () use ($resource) {
                    return $resource->author;
                },
            ],
            'comments'     => [
                self::SHOW_SELF    => false,
                self::SHOW_RELATED => false,
                self::SHOW_DATA    => isset($includeRelationships['comments']),
                self::DATA         => function () use ($resource) {
                    return $resource->comments;
                },
            ],
        ];
    }
}
