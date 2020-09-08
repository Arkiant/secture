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

    private static $requiredValues = ["name", "price", "team", "position"];

    public static function validateProperties(array $data): array
    {
        $values = array_diff(self::$requiredValues, array_keys($data));
        return ["result" => !(count($values) > 0), "values" => $values];
    }

    public static function validateEmptyProperties(array $data): array
    {
        $empty = array_filter($data, function ($v) {
            return empty($v);
        });

        return ["result" => !(count($empty) > 0), "values" => array_keys($empty)];
    }

    public static function validate(array $data)
    {

        $validateProperties = self::validateProperties($data);
        if (!$validateProperties["result"]) {
            throw new PropertyNotExistsException(join(", ", $validateProperties["values"]));
        }

        $validateEmpty = self::validateEmptyProperties($data);
        if (!$validateEmpty["result"]) {
            throw new EmptyArgumentException(join(", ", $validateEmpty["values"]));
        }

        $positionValidation = new PositionValidation();
        if (!$positionValidation->exists($data["position"])) {
            throw new PositionNotFoundException($data["position"]);
        }
    }
}
