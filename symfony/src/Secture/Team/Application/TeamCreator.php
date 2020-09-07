<?php

namespace App\Secture\Team\Application;

use App\Secture\Team\Domain\Errors\DuplicateException;
use App\Secture\Team\Domain\Errors\EmptyArgumentException;
use App\Secture\Team\Domain\Errors\NotFoundException;
use App\Secture\Team\Domain\Errors\NullException;
use App\Secture\Team\Domain\Errors\PropertyNotExistsException;
use App\Secture\Team\Domain\Team;
use App\Secture\Team\Domain\TeamID;

class TeamCreator extends WithTeamRepository
{
    public function create(array $data): TeamID
    {
        if (is_null($data)) {
            throw new NullException();
        }

        if (!array_key_exists("name", $data)) {
            throw new PropertyNotExistsException("name");
        }

        if (empty($data["name"])) {
            throw new EmptyArgumentException("name");
        }

        if ($this->getRepository()->exists($data["name"])) {
            throw new DuplicateException($data["name"]);
        }

        return $this->getRepository()->create($data["name"]);
    }

    public function read(TeamID $id): Team
    {
        $data = $this->getRepository()->read($id);
        if (is_null($data)) {
            throw new NotFoundException($id);
        }
        return $data;
    }

    public function update(Team $team): Team
    {
        $data = $this->getRepository()->update($team);
        if (is_null($data)) {
            throw new NotFoundException($team->GetID());
        }
        return $data;
    }

    public function delete(TeamID $id): TeamID
    {
        $data = $this->getRepository()->delete($id);
        if (is_null($data)) {
            throw new NotFoundException($id);
        }
        return $data;
    }

    public function getAll(): array
    {
        $data = $this->getRepository()->findAll();
        if (!$data) {
            // TODO: throw no result exception
        }

        return $data;
    }
}
