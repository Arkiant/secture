<?php

namespace App\Secture\PlayerFilters\Domain;

use App\Secture\Player\Domain\Player;

/**
 * Filter array list by team name
 * 
 * @param array list
 * @param string $team
 * 
 * @return array filterList
 */
function FilterByTeam(array $list, string $team): array
{
    return array_filter($list, function (Player $player) use ($team) {
        return $player->GetTeam()->GetName() == $team;
    });
}
