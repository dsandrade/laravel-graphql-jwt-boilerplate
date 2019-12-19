<?php

namespace App\Services\Handlers\Users;

use Exception;
use App\Contracts\CommandInterface;
use App\Contracts\HandlerInterface;
use App\Exceptions\HandlerException;
use App\Repositories\UserRepository;
use App\Http\GraphQL\Traits\UserFormatter;

class CreateUser implements HandlerInterface
{
    use UserFormatter;

    /**
     * @var UserRepository
     */
    protected $repository;

    /**
     * CreateUser constructor.
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param CommandInterface $command
     * @return null|Object
     * @throws Exception
     */
    public function handle(CommandInterface $command):? Object
    {
        try {
            $user  = $this->repository->create($command->getData());
            $token = auth()->login($user);

            return $this->parseUserAndTokenData($token, $user);
        } catch (Exception $error) {
            throw new HandlerException($error->getMessage());
        }
    }
}
