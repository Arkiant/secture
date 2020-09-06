<?php

namespace App\Secture\PlayerFilters\Domain;

use App\Secture\Player\Domain\Player;
use App\Secture\Player\Domain\Position;

/**
 * Filter array list by position
 * 
 * @param array list
 * @param Position $position
 * 
 * @return array filterList
 */
function FilterByPosition(array $list, Position $position): array
{
    return array_filter($list, function (Player $player) use ($position) {
        return $player->GetPosition() == $position;
    });
}
