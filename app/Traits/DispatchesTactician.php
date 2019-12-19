<?php

namespace App\Traits;

trait DispatchesTactician
{
    /**
     * @param mixed $command
     * @return mixed
     */
    public function dispatchTactician($command)
    {
        return app('bus')->handle($command);
    }
}
