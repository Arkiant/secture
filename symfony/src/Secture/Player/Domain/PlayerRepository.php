<?php

namespace App\Secture\Player\Domain;

use App\Secture\Team\Domain\Team;

interface PlayerRepository
{
    public function GetPlayerFilterByTeam(Team $team);
    public function GetPlayerFilterByPosition(Position $position);
    public function GetPlayerFilterByTeamAndByPosition(Team $team, Position $position);
}
