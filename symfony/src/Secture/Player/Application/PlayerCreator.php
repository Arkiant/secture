<?php

namespace App\Secture\Player\Application;

use App\Secture\Player\Domain\Errors\DuplicateException;
use App\Secture\Player\Domain\Errors\NoResultsException;
use App\Secture\Player\Domain\Errors\NotFoundException;
use App\Secture\Player\Domain\Player;
use App\Secture\Player\Domain\PlayerValidation;
use App\Secture\Team\Domain\Team;
use Exception;

class PlayerCreator extends WithPlayerRepository
{
    public function create(array $data): Player
    {

        PlayerValidation::validate($data);

        if ($this->getRepository()->exists($data["name"])) {
            throw new DuplicateException($data["name"]);
        }

        return $this->getRepository()->create($data["name"], $data["price"], $data["position"], $data["team"]);
    }

    public function read(int $id, ?string $currency): Player
    {
        $data = $this->getRepository()->read($id);

        $converted = $this->getConverter()->convert($data, $currency);

        if (is_null($data)) {
            throw new NotFoundException($id);
        }
        return $converted;
    }

    public function update(array $data, int $id): Player
    {

        PlayerValidation::validate($data);

        $player = new Player($id, $data["name"], $data["price"], new Team($data["team"], ""), $data["position"]);

        $updatedPlayer = $this->getRepository()->update($player);
        if (is_null($updatedPlayer)) {
            throw new NotFoundException($data["name"]);
        }
        return $updatedPlayer;
    }

    public function delete(int $id): int
    {
        $data = $this->getRepository()->delete($id);
        if (is_null($data)) {
            throw new NotFoundException($id);
        }
        return $data;
    }

    public function getAll(?string $team, ?string $position, ?string $currency): array
    {

        $filter = [];
        if ($team) {
            $filter["team"] = $team;
        }

        if ($position) {
            $filter["position"] = $position;
        }

        $data = $this->getRepository()->findAll($filter);
        if (!$data) {
            throw new NoResultsException();
        }

        $convertedPlayer = [];
        foreach ($data as $player) {
            $converted = $this->getConverter()->convert($player, $currency);
            array_push($convertedPlayer, $converted);
        }

        return $convertedPlayer;
    }
}
