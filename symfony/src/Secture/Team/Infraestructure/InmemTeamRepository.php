<?php

namespace App\Secture\Team\Infraestructure;

use App\Secture\Team\Domain\Team;
use App\Secture\Team\Domain\TeamID;
use App\Secture\Team\Domain\TeamRepository;
use Exception;

class InmemTeamRepository implements TeamRepository
{

    public function create(string $name): TeamID
    {
        $team = new Team(1, $name);
        return $team->GetID();
    }

    public function read(TeamID $id): ?Team
    {
        throw new Exception("not implemented");
    }

    public function update(Team $team): ?Team
    {
        throw new Exception("not implemented");
    }

    public function delete(TeamID $id): ?TeamID
    {
        throw new Exception("not implemented");
    }

    public function exists(string $name): bool
    {
        return false;
    }

    public function findAll(): ?array
    {
        throw new Exception("not implemented");
    }
}
