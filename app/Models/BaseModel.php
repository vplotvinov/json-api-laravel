<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'updatedAt';
    public static $snakeAttributes = false;

    public function getCreatedAtAttribute($value)
    {
        return Carbon::createFromTimeString($value)->timestamp;
    }
}

