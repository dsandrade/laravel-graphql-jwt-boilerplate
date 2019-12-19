<?php

namespace App\Http\GraphQL\Traits;

use stdClass;
use App\Models\User;

trait UserFormatter
{
    /**
     * @param string $token
     * @param User $user
     * @return Object
     */
    public function parseUserAndTokenData(
        string $token,
        User $user
    ): Object {
        $tokenClass        = new stdClass();
        $tokenClass->token = $token;
        $tokenClass->user  = $user;

        return $tokenClass;
    }
}
