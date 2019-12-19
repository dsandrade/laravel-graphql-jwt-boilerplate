<?php

namespace App\Services\Commands\Users;

use App\Contracts\CommandInterface;

class DeleteUser implements CommandInterface
{
    /**
     * @var int
     */
    protected $userId;

    /**
     * DeleteUser constructor.
     * @param int $userId
     */
    public function __construct(int $userId)
    {
        $this->userId = $userId;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }
}
