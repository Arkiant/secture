<?php

namespace App\Secture\Team\Domain;

class Team implements \JsonSerializable
{
    private TeamID $id;
    private string $name;

    public function __construct(int $id, string $name)
    {
        $this->id = new TeamID($id);
        $this->name = $name;
    }

    public function GetName(): string
    {
        return $this->name;
    }

    public function GetID(): TeamID
    {
        return $this->id;
    }

    public function jsonSerialize()
    {
        return
            [
                'id' => $this->GetID()->getID(),
                'name' => $this->getName()
            ];
    }
}
