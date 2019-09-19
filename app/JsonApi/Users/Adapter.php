<?php

namespace App\JsonApi\Users;

use App\Models\UserModel;
use App\Scopes\AccountScope;
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
    protected $attributes = [
        'roleId'   => 'userRoleId',
        'statusId' => 'userStatusId',
    ];

    /**
     * Adapter constructor.
     *
     * @param StandardStrategy $paging
     */
    public function __construct(StandardStrategy $paging)
    {
        parent::__construct(new UserModel(), $paging);
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
        if ($authors = $filters->get('me')) {
            $currentUserId = Auth::user()->toArray()['id'];
            $query->where('id',  '=', $currentUserId); // Current User ID
        }
    }
}
