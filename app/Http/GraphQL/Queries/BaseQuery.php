<?php

namespace App\Http\GraphQL\Queries;

use Rebing\GraphQL\Support\Query;
use App\Http\GraphQL\Traits\AuthorizationTrait;
use Madewithlove\Tactician\Traits\DispatchesJobs;

abstract class BaseQuery extends Query
{
    use DispatchesJobs,
        AuthorizationTrait;
}
