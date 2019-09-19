<?php

namespace App\Repositories;

use App\Models\BaseModel;
use Illuminate\Support\Facades\DB;

abstract class AbstractBaseRepository
{

    /** @var BaseModel */
    protected $model;

    public function beginTransaction()
    {
        DB::beginTransaction();
    }

    public function rollBackTransaction()
    {
        DB::rollBack();
    }

    public function commitTransaction()
    {
        DB::commit();
    }
}
