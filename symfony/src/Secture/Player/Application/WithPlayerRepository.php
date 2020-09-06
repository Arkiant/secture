<?php

namespace App\Secture\Player\Application;

use App\Secture\Player\Domain\PlayerRepository;
use App\Secture\Team\Domain\TeamRepository;

abstract class WithPlayerRepository
{
    private PlayerRepository $repository;
    private TeamRepository $teamRepository;

    public function __construct(PlayerRepository $playerRepository)
    {
        $this->repository = $playerRepository;
    }

    public function getRepository(): PlayerRepository
    {
        return $this->repository;
    }
}
