<?php

namespace App\Services\Handlers\Users;

use Exception;
use App\Models\User;
use App\Contracts\CommandInterface;
use App\Contracts\HandlerInterface;
use App\Exceptions\HandlerException;
use App\Exceptions\NotAuthorizedException;
use App\Http\GraphQL\Traits\UserFormatter;

class LogIn implements HandlerInterface
{
    use UserFormatter;

    /**
     * @param CommandInterface $command
     * @return null|Object
     * @throws Exception
     */
    public function handle(CommandInterface $command):? Object
    {
        try {
            $token = auth()->attempt($command->getData());

            if (! $token) {
                throw new NotAuthorizedException();
            }

            /** @var User $user */
            $user  = auth()->user();

            if (!$token) {
                throw new NotAuthorizedException();
            }

            return $this->parseUserAndTokenData($token, $user);
        } catch (Exception $error) {
            throw new HandlerException($error->getMessage());
        }
    }
}
