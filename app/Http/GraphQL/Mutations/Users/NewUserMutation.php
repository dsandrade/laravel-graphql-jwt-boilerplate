<?php

namespace App\Http\GraphQL\Mutations\Users;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use App\Services\Commands\Users\CreateUser;
use App\Http\GraphQL\Mutations\BaseMutation;
use App\Http\GraphQL\Traits\AuthorizationTrait;

class NewUserMutation extends BaseMutation
{
    use AuthorizationTrait;

    /**
     * @var array
     */
    protected $attributes = [
        'name' => 'NewUser'
    ];

    /**
     * @return Type
     */
    public function type(): Type
    {
        return GraphQL::type('token');
    }

    /**
     * @param array $args
     * @return array
     */
    public function rules(array $args = []): array
    {
        return [
            'username' => ['required'],
            'name' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required'],
            'role_id' => ['required']
        ];
    }

    /**
     * @return array
     */
    public function args(): array
    {
        return [
            'username' => [
                'name' => 'username',
                'type' => Type::nonNull(Type::string())
            ],
            'name' => [
                'name' => 'name',
                'type' => Type::nonNull(Type::string())
            ],
            'email' => [
                'name' => 'email',
                'type' => Type::nonNull(Type::string())
            ],
            'password' => [
                'name' => 'password',
                'type' => Type::nonNull(Type::string())
            ],
            'image' => [
                'name' => 'image',
                'type' => Type::nonNull(Type::string())
            ],
            'role_id' => [
                'name' => 'role_id',
                'type' => Type::nonNull(Type::int())
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
        return $this->dispatch(new CreateUser($args));
    }
}
