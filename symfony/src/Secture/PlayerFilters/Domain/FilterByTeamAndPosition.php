<?php

namespace App\Secture\PlayerFilters\Domain;

use App\Secture\Player\Domain\Position;

/**
 * Filter array list by team name and position
 * 
 * @param array list
 * @param string $team
 * @param Position $position
 * 
 * @return array filterList
 */
function FilterByTeamAndPosition(array $list, string $team, Position $position): array
{
    return FilterByPosition(FilterByTeam($list, $team), $position);
}
