<?php

namespace App\Secture\Player\Domain\Validation;

/**
 * Validate position is inside availablePosition array.
 */
class PositionValidation
{
    private static $availablePositions = ["goalkeeper", "defender", "midfielder", "forward"];

    public static function validate(string $position): bool
    {
        return array_search($position, self::$availablePositions) !== FALSE;
    }
}
