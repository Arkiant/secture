<?php

namespace App\Secture\Player\Domain;

interface PlayerRepository
{
    public function create(string $name, float $price, string $position, int $team): Player;
    public function read(int $id): ?Player;
    public function update(Player $player): ?Player;
    public function delete(int $id): ?int;
    public function getByPosition(string $position): ?array;
    public function findAll();
    public function exists(string $name): bool;
}
