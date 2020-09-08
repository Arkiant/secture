<?php

namespace App\Secture\Player\Domain;

interface PlayerRepository
{
    public function create(string $name, float $price, string $position, int $team): int;
    public function read(int $id): ?Player;
    public function update(Player $player): ?Player;
    public function delete(int $id): ?int;
    public function findAll(array $filter);
    public function exists(string $name): bool;
}
