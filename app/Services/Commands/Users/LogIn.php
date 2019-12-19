<?php

namespace App\Services\Commands\Users;

use App\Contracts\CommandInterface;

class LogIn implements CommandInterface
{
    /**
     * @var array
     */
    protected $data;

    /**
     * LogIn constructor.
     * @param array $data
     */
    public function __construct(
        array $data
    ) {
        $this->data = $data;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }
}
