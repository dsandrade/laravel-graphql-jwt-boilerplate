<?php

namespace App\Http\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;

class TokenType extends GraphQLType
{
    /**
     * @var array
     */
    protected $attributes = [
        'name' => 'Token',
        'description' => 'A type'
    ];

    /**
     * define field of type
     *
     * @return array
     */
    public function fields(): array
    {
        return [
            'token' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The access token of the user'
            ],
            'user' => [
                'type' => GraphQL::type('user'),
                'description' => 'User data'
            ]
        ];
    }
}
