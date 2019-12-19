<?php

namespace App\Http\GraphQL\Queries\Users;

use Closure;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Collection;
use App\Http\GraphQL\Queries\BaseQuery;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\Facades\GraphQL;
use App\Services\Commands\Users\GetUserWhere;

class UsersQuery extends BaseQuery
{
    /**
     * @var array
     */
    protected $attributes = [
        'name' => 'Users Query',
        'description' => 'A query of users'
    ];

    /**
     * @return Type
     */
    public function type(): Type
    {
        // result of query with pagination laravel
        return Type::listOf(GraphQL::type('user'));
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
            'email' => [
                'name' => 'email',
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

        foreach ($context->getRelations() as $roleName => $field) {
            if ($roleName === 'role') {
                $with->push($roleName);
            }
        }

        if (isset($args['id'])) {
            $where->put('id', $args['id']);
        }

        if (isset($args['email'])) {
            $where->put('email', $args['email']);
        }

        $where->push(['email', '<>', [config('app.root_user.email')]]);

        return $this->dispatch(new GetUserWhere(
            $where->toArray(),
            ['*'],
            $with->toArray()
        ));
    }
}
