<?php

namespace App\Services\Handlers\Users;

use Exception;
use Illuminate\Support\Collection;
use App\Contracts\CommandInterface;
use App\Contracts\HandlerInterface;
use App\Exceptions\HandlerException;
use App\Repositories\UserRepository;

class GetUserWhere implements HandlerInterface
{
    /**
     * @var UserRepository
     */
    protected $repository;

    /**
     * GetUserWhere constructor.
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param CommandInterface $command
     * @return Collection
     * @throws HandlerException
     */
    public function handle(CommandInterface $command): Collection
    {
        try {
            return $this->repository
                ->with($command->getWith())
                ->findWhere(
                    $command->getWhere(),
                    $command->getColumns()
                );
        } catch (Exception $error) {
            throw new HandlerException($error->getMessage());
        }
    }
}
