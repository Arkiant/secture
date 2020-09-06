<?php

namespace App\Secture\Team\Domain;

class TeamID
{
    private int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function getID(): int
    {
        return $this->id;
    }
}
