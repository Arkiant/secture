<?php

namespace App\Secture\Team\Domain;

use App\Secture\Team\Domain\Team;
use App\Secture\Team\Domain\TeamID;

interface TeamRepository
{
    public function create(string $name): int;
    public function read(TeamID $id): ?Team;
    public function update(Team $team): ?Team;
    public function delete(TeamID $id): ?int;
    public function exists(string $name): bool;
    public function findAll(): ?array;
}
