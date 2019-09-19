<?php

namespace App\Models;

use App\Models\UserModel as UserModel;

/**
 * Class Comment
 * @package App\Models
 */
class CommentModel extends BaseModel
{
    protected $table = 'comments';
    protected $fillable = [
        'id',
        'text',
        'authorId',
        'entityId',
        'createdAt',
    ];

    protected $hidden = [
        'updatedAt',
    ];

    public function entity()
    {
        return $this->belongsTo(EntityModel::class, 'entityId');
    }

    public function user()
    {
        // TODO: Remove this relation
        return $this->belongsTo(UserModel::class, 'authorId');
    }

    public function author()
    {
        return $this->belongsTo(UserModel::class, 'authorId');
    }
}
