<?php

namespace App\Secture\Player\Domain;

class PositionValidation
{
    private static $availablePositions = ["goalkeeper", "defender", "midfielder", "forward"];

    public static function exists(string $position): bool
    {
        return array_search($position, self::$availablePositions) !== FALSE;
    }
}
