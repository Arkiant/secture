<?php

declare(strict_types=1);

namespace App\Secture\Player\Domain;

use App\Secture\Team\Domain\Team;
use App\Secture\Player\Domain\Position;

class Player
{
    private string $name;
    private float $price;
    private Team $team;
    private Position $position;

    public function GetPosition(): Position
    {
        return $this->position;
    }

    public function GetTeam(): Team
    {
        return $this->team;
    }
}
