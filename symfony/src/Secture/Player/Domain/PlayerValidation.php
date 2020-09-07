<?php

namespace App\Secture\Player\Domain;

use App\Secture\Player\Domain\Errors\EmptyArgumentException;
use App\Secture\Player\Domain\Errors\NullException;
use App\Secture\Player\Domain\Errors\PositionNotFoundException;
use App\Secture\Player\Domain\Errors\PropertyNotExistsException;

/**
 * Validate player properties:
 * 
 * - Required values
 * - No empty values
 * - Valid positions
 */
class PlayerValidation
{
    public static function validate(array $data)
    {

        $requiredValues = ["name", "price", "position", "team"];

        if (is_null($data)) {
            throw new NullException();
        }

        $values = array_diff($requiredValues, array_keys($data));
        if (count($values) > 0) {
            throw new PropertyNotExistsException(join(", ", $values));
        }

        $empty = array_filter($data, function ($v) {
            return empty($v);
        });
        if (count($empty) > 0) {
            throw new EmptyArgumentException(join(", ", array_keys($empty)));
        }

        $positionValidation = new PositionValidation();
        if (!$positionValidation->exists($data["position"])) {
            throw new PositionNotFoundException($data["position"]);
        }
    }
}
