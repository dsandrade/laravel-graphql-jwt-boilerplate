<?php

namespace App\Services\Handlers\Users;

use Exception;
use App\Contracts\CommandInterface;
use App\Contracts\HandlerInterface;
use App\Exceptions\HandlerException;
use App\Repositories\UserRepository;
use App\Http\GraphQL\Traits\UserFormatter;

class DeleteUser implements HandlerInterface
{
    use UserFormatter;

    /**
     * @var UserRepository
     */
    protected $repository;

    /**
     * DeleteUser constructor.
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param CommandInterface $command
     * @return null|string
     * @throws Exception
     */
    public function handle(CommandInterface $command):? string
    {
        try {
            $this->repository->delete(
                $command->getUserId()
            );

            return 'User successfully deleted.';
        } catch (Exception $error) {
            throw new HandlerException($error->getMessage());
        }
    }
}
