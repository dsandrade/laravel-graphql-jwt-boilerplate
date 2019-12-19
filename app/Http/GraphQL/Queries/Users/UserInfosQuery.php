<?php

namespace App\Http\GraphQL\Queries\Users;

use Closure;
use App\Models\User;
use GraphQL\Type\Definition\Type;
use App\Http\GraphQL\Queries\BaseQuery;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\Facades\GraphQL;

class UserInfosQuery extends BaseQuery
{
    /**
     * @var array
     */
    protected $attributes = [
        'name' => 'User Info Query',
        'description' => 'A query of user informations'
    ];

    /**
     * @return Type
     */
    public function type(): Type
    {
        return GraphQL::type('user');
    }

    /**
     * @param mixed $root
     * @param array $args
     * @param mixed $context
     * @param ResolveInfo $resolveInfo
     * @param Closure $getSelectFields
     * @return User
     */
    public function resolve(
        $root,
        array $args,
        $context,
        ResolveInfo $resolveInfo,
        Closure $getSelectFields
    ) {
        /** @var User $user */
        $user = auth()->user();

        return $user;
    }
}
