<?php

declare(strict_types=1);

namespace App\Secture\Player\Domain;

use App\Secture\Team\Domain\Team;

class Player implements \JsonSerializable
{
    private int $id;
    private string $name;
    private float $price;
    private Team $team;
    private string $position;

    public function __construct(int $id, string $name, float $price, Team $team, string $position)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->team = $team;
        $this->position = $position;
    }

    public function GetID(): int
    {
        return $this->id;
    }

    public function GetName(): string
    {
        return $this->name;
    }

    public function GetPrice(): float
    {
        return $this->price;
    }

    public function GetPosition(): string
    {
        return $this->position;
    }

    public function GetTeam(): Team
    {
        return $this->team;
    }

    public function SetTeam(Team $team)
    {
        return $this->team = $team;
    }

    public function jsonSerialize()
    {
        return
            [
                'id' => $this->id,
                'name' => $this->name,
                'price' => $this->price,
                'team' => $this->team,
                'position' => $this->position
            ];
    }
}
