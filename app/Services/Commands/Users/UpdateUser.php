<?php

namespace App\Services\Commands\Users;

use App\Contracts\CommandInterface;

class UpdateUser implements CommandInterface
{
    /**
     * @var int
     */
    protected $userId;

    /**
     * @var array
     */
    protected $data;

    /**
     * UpdateUser constructor.
     * @param int $userId
     * @param array $data
     */
    public function __construct(int $userId, array $data)
    {
        if (isset($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }
        $this->data       = $data;
        $this->userId     = $userId;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }
}
