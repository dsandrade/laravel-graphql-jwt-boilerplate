<?php

namespace App\Http\GraphQL\Mutations\Users;

use GraphQL\Type\Definition\Type;
use App\Services\Commands\Users\UpdateUser;
use Rebing\GraphQL\Support\Facades\GraphQL;
use App\Http\GraphQL\Mutations\BaseMutation;
use App\Http\GraphQL\Traits\AuthorizationTrait;

class UpdateUserMutation extends BaseMutation
{
    use AuthorizationTrait;

    /**
     * @var array
     */
    protected $attributes = [
        'name' => 'UpdateUser'
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
            'id' => ['required'],
            'username' => ['required'],
            'name' => ['required'],
            'email' => ['required', 'email'],
            'role_id' => ['required']
        ];
    }

    /**
     * @return array
     */
    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::nonNull(Type::int())
            ],
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
            'image' => [
                'name' => 'image',
                'type' => Type::string()
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
        $userId = $args['id'];
        unset($args['id']);

        return $this->dispatch(new UpdateUser($userId, $args));
    }
}
