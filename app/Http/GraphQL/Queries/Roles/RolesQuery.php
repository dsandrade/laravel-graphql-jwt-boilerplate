<?php

namespace App\Http\GraphQL\Queries\Roles;

use Closure;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Collection;
use App\Http\GraphQL\Queries\BaseQuery;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\Facades\GraphQL;
use App\Services\Commands\Roles\GetRoleWhere;

class RolesQuery extends BaseQuery
{
    /**
     * @var array
     */
    protected $attributes = [
        'name' => 'Roles Query',
        'description' => 'A query of roles'
    ];

    /**
     * @return Type
     */
    public function type(): Type
    {
        // result of query with pagination laravel
        return Type::listOf(GraphQL::type('role'));
    }

    /**
     * arguments to filter query
     *
     * @return array
     */
    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::int()
            ],
            'name' => [
                'name' => 'name',
                'type' => Type::string()
            ]
        ];
    }

    /**
     * @param mixed $root
     * @param array $args
     * @param mixed $context
     * @param ResolveInfo $resolveInfo
     * @param Closure $getSelectFields
     * @return Collection
     */
    public function resolve(
        $root,
        array $args,
        $context,
        ResolveInfo $resolveInfo,
        Closure $getSelectFields
    ): Collection {
        $with = collect([]);
        $where = collect([]);

        if (isset($args['id'])) {
            $where->put('id', $args['id']);
        }

        if (isset($args['name'])) {
            $where->put('name', $args['name']);
        }

        return $this->dispatch(new GetRoleWhere(
            $where->toArray(),
            ['*'],
            $with->toArray()
        ));
    }
}
