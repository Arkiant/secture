<?php

namespace App\Secture\Application\Team;

use App\Secture\Team\Domain\Errors\DuplicateException;
use App\Secture\Team\Domain\Errors\EmptyArgumentException;
use App\Secture\Team\Domain\Errors\NotFoundException;
use App\Secture\Team\Domain\Errors\NullException;
use App\Secture\Team\Domain\Errors\PropertyNotExistsException;
use App\Secture\Team\Domain\Team;
use App\Secture\Team\Domain\TeamID;
use App\Secture\Team\Domain\TeamRepository;

class TeamCreator
{
    private TeamRepository $repository;

    public function __construct(TeamRepository $teamRepository)
    {
        $this->repository = $teamRepository;
    }

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

        if ($this->repository->exists($data["name"])) {
            throw new DuplicateException($data["name"]);
        }

        return $this->repository->create($data["name"]);
    }

    public function read(TeamID $id): Team
    {
        $data = $this->repository->read($id);
        if (is_null($data)) {
            throw new NotFoundException($id);
        }
        return $data;
    }

    public function update(Team $team): Team
    {
        $data = $this->repository->update($team);
        if (is_null($data)) {
            throw new NotFoundException($team->GetID());
        }
        return $data;
    }

    public function delete(TeamID $id): TeamID
    {
        $data = $this->repository->delete($id);
        if (is_null($data)) {
            throw new NotFoundException($id);
        }
        return $data;
    }
}
