<?php

namespace App\JsonApi\Comments;

use App\Models\CommentModel;
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
    protected $attributes = [];

    protected $relationships = [
        'author',
        'author.role',
        'author.status',
    ];

    /**
     * Adapter constructor.
     *
     * @param StandardStrategy $paging
     */
    public function __construct(StandardStrategy $paging)
    {
        parent::__construct(new CommentModel(), $paging);
        $this->addScopes(new AccountScope());
    }

    public function author()
    {
        return $this->hasOne('user');
    }

    protected function creating(CommentModel $comment)
    {
        $currentUser        = Auth::user()->toArray();
        $comment->accountId = $currentUser['accountId'];

        return $comment;
    }

    /**
     * @param Builder    $query
     * @param Collection $filters
     *
     * @return void
     */
    protected function filter($query, Collection $filters)
    {
        // TODO
    }

}
