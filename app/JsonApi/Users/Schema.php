<?php

namespace App\JsonApi\Users;

use Neomerx\JsonApi\Schema\SchemaProvider;

class Schema extends SchemaProvider
{

    /**
     * @var string
     */
    protected $resourceType = 'users';

    /**
     * @var array
     */
    protected $attributes = [
        'firstName',
        'lastName',
//        'email',
//        'accountId',
        'avatarUrl',
        'userRoleId',
        'lastLoginAt',
        'createdAt',
    ];

    /**
     * @var array
     */
    protected $relationships = [
        'role',
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
            'firstName'      => $resource->firstName,
            'lastName'       => $resource->lastName,
            'email'          => $resource->email,
            'accountId'      => $resource->accountId,
            'avatarUrl'      => $resource->avatarUrl,
            'roleId'         => $resource->userRoleId,
            'lastLoginAt'    => $resource->lastLoginAt,
            'createdAt'      => $resource->createdAt,
        ];
    }

    public function getRelationships($resource, $isPrimary, array $includeRelationships)
    {
        return [
            'role'   => [
                self::SHOW_SELF    => false,
                self::SHOW_RELATED => false,
                self::SHOW_DATA    => isset($includeRelationships['role']),
                self::DATA         => function () use ($resource) {
                    return $resource->role;
                },
            ]
        ];
    }
}
