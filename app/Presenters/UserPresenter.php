<?php

namespace App\Presenters;

class UserPresenter extends BasePresenter
{
    /**
     * @return bool
     */
    public function isAdminUser(): bool
    {
        return $this->role->name === 'admin';
    }
}
