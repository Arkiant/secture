<?php

namespace App\Secture\Player\Infraestructure;

use App\Secture\Player\Domain\PlayerRepository;
use App\Secture\Player\Domain\Position;
use App\Secture\Team\Domain\Team;
use App\Repository\PlayerRepository as DPlayerRepository;
use Doctrine\Persistence\ManagerRegistry;

class DoctrinePlayerRepository implements PlayerRepository
{

    private DPlayerRepository $repository;

    public function __constructor(ManagerRegistry $registry)
    {
        $this->repository = new DPlayerRepository($registry);
    }

    public function GetPlayerFilterByTeam(Team $team)
    {
        $result = $this->repository->findByTeam($team->GetName());

        print($result);
        die();
    }
    public function GetPlayerFilterByPosition(Position $position)
    {
    }
    public function GetPlayerFilterByTeamAndByPosition(Team $team, Position $position)
    {
    }
}
