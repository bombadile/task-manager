<?php

declare(strict_types=1);

namespace App\Repository;

use App\Model\User;

class UserRepository extends AbstractRepository
{
    /**
     * @return string
     */
    public function getModelName(): string
    {
        return $this->getMetadataName(User::class);
    }
}
