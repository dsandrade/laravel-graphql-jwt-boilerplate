<?php

namespace App\Http\GraphQL\Types;

use App\Models\User;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;

class UserType extends GraphQLType
{
    /**
     * @var array
     */
    protected $attributes = [
        'name' => 'Users',
        'description' => 'A type',
        'model' => User::class
    ];

    /**
     * define field of type
     *
     * @return array
     */
    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The id of the user'
            ],
            'email' => [
                'type' => Type::string(),
                'description' => 'The email of user'
            ],
            'name' => [
                'type' => Type::string(),
                'description' => 'The name of the user'
            ],
            'username' => [
                'type' => Type::string(),
                'description' => 'The username of the user'
            ],
            'image' => [
                'type' => Type::string(),
                'description' => 'The image of the user'
            ],
            // field relation to model role
            'role' => [
                'type' => GraphQL::type('role'),
                'description' => 'The role of the user'
            ]
        ];
    }

    /**
     * @param mixed $root
     * @param array $args
     * @return string
     */
    protected function resolveEmailField($root, array $args): string
    {
        return strtolower($root->email);
    }
}
