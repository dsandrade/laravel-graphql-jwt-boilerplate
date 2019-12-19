<?php

namespace App\Http\GraphQL\Mutations\Users;

use Exception;
use App\Models\User;
use GraphQL\Type\Definition\Type;
use App\Exceptions\NotAuthorizedException;
use App\Http\GraphQL\Traits\UserFormatter;
use Rebing\GraphQL\Support\Facades\GraphQL;
use App\Http\GraphQL\Mutations\BaseMutation;

class RefreshTokenMutation extends BaseMutation
{
    use UserFormatter;

    /**
     * @var array
     */
    protected $attributes = [
        'name' => 'RefreshToken'
    ];

    /**
     * @return Type
     */
    public function type(): Type
    {
        return GraphQL::type('token');
    }

    /**
     * @param mixed $root
     * @param array $args
     * @return null|Object
     * @throws Exception
     */
    public function resolve($root, array $args):? Object
    {
        try {
            $token = auth()->refresh();
            auth()->setToken($token);

            /** @var User $user */
            $user = auth()->user();

            return $this->parseUserAndTokenData($token, $user);
        } catch (Exception $exception) {
            throw new NotAuthorizedException('Unauthorized');
        }
    }
}
