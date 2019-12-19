<?php

namespace App\Http\GraphQL\Mutations\Users;

use GraphQL\Type\Definition\Type;
use App\Services\Commands\Users\UpdateUser;
use Rebing\GraphQL\Support\Facades\GraphQL;
use App\Http\GraphQL\Mutations\BaseMutation;
use App\Http\GraphQL\Traits\AuthorizationTrait;

class UpdateUserPasswordMutation extends BaseMutation
{
    use Authorizationtrait;

    /**
     * @var array
     */
    protected $attributes = [
        'name' => 'updateUserPassword'
    ];

    /**
     * @return Type
     */
    public function type(): Type
    {
        return GraphQL::type('token');
    }

    /**
     * @return array
     */
    public function args(): array
    {
        return [
            'id'       => [
                'name'  => 'id',
                'type'  => Type::nonNull(Type::int()),
                'rules' => ['required']
            ],
            'password' => [
                'name'  => 'password',
                'type'  => Type::nonNull(Type::string()),
                'rules' => ['required']
            ]
        ];
    }

    /**
     * @param mixed $root
     * @param array $args
     * @return null|Object
     */
    public function resolve($root, array $args):? Object
    {
        return $this->dispatch(new UpdateUser($args['id'], [
            'password' => $args['password']
        ]));
    }
}
