<?php

namespace App\Http\GraphQL\Mutations;

use Rebing\GraphQL\Support\Mutation;
use Madewithlove\Tactician\Traits\DispatchesJobs;

abstract class BaseMutation extends Mutation
{
    use DispatchesJobs;
}
