<?php

namespace App\Http\GraphQL\Mutations\Users;

use GraphQL\Type\Definition\Type;
use App\Services\Commands\Users\DeleteUser;
use App\Http\GraphQL\Mutations\BaseMutation;
use App\Http\GraphQL\Traits\AuthorizationTrait;

class DeleteUserMutation extends BaseMutation
{
    use Authorizationtrait;

    /**
     * @var array
     */
    protected $attributes = [
        'name' => 'DeleteUser'
    ];

    /**
     * @return Type
     */
    public function type(): Type
    {
        return Type::string();
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
            ]
        ];
    }

    /**
     * @param mixed $root
     * @param array $args
     * @return null|string
     */
    public function resolve($root, array $args):? string
    {
        return $this->dispatch(new DeleteUser($args['id']));
    }
}
