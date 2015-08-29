<?php

namespace PS\Repositories\Contract;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface ProjectRepository
 * @package namespace PS\Repositories;
 */
interface ProjectRepository extends RepositoryInterface
{
    public function isOwner($projectId, $userId);
}
