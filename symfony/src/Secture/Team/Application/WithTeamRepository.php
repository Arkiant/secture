<?php

namespace App\Secture\Team\Application;

use App\Secture\Team\Domain\TeamRepository;

class WithTeamRepository
{
    private TeamRepository $repository;

    public function __construct(TeamRepository $teamRepository)
    {
        $this->repository = $teamRepository;
    }

    public function getRepository(): TeamRepository
    {
        return $this->repository;
    }
}
