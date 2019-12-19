<?php

namespace App\Http\GraphQL\Mutations\Users;

use GraphQL\Type\Definition\Type;
use App\Services\Commands\Users\LogIn;
use Rebing\GraphQL\Support\Facades\GraphQL;
use App\Http\GraphQL\Mutations\BaseMutation;

class LogInMutation extends BaseMutation
{
    /**
     * @var array
     */
    protected $attributes = [
        'name' => 'LogIn'
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
            'email' => [
                'name' => 'email',
                'type' => Type::nonNull(Type::string()),
                'rules' => ['required', 'email'],
            ],
            'password' => [
                'name' => 'password',
                'type' => Type::nonNull(Type::string()),
                'rules' => ['required']
            ]
        ];
    }

    /**
     * @param mixed $root
     * @param array $args
     * @return Object|null
     */
    public function resolve($root, array $args):? Object
    {
        $credentials = [
            'email' => $args['email'],
            'password' => $args['password']
        ];

        return $this->dispatch(new LogIn($credentials));
    }
}
