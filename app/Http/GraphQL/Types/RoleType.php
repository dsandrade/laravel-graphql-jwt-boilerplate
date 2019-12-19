<?php

namespace App\Http\GraphQL\Types;

use App\Models\Role;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class RoleType extends GraphQLType
{
    /**
     * @var array
     */
    protected $attributes = [
        'name' => 'Role',
        'description' => 'A role',
        'model' => Role::class
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
                'description' => 'The id of the role'
            ],
            'name' => [
                'type' => Type::string(),
                'description' => 'The name of role'
            ]
        ];
    }
}
