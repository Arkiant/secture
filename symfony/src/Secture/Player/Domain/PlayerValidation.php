<?php

namespace App\Secture\Player\Domain;

use App\Secture\Player\Domain\Errors\EmptyArgumentException;
use App\Secture\Player\Domain\Errors\PositionNotFoundException;
use App\Secture\Player\Domain\Errors\PropertyNotExistsException;
use App\Secture\Player\Domain\Validation\ValidateEmptyProperties;
use App\Secture\Player\Domain\Validation\ValidateRequiredProperties;

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

        $validateProperties = ValidateRequiredProperties::validate($data);
        if (!$validateProperties["result"]) {
            throw new PropertyNotExistsException(join(", ", $validateProperties["values"]));
        }

        $validateEmpty = ValidateEmptyProperties::validate($data);
        if (!$validateEmpty["result"]) {
            throw new EmptyArgumentException(join(", ", $validateEmpty["values"]));
        }

        $positionValidation = new PositionValidation();
        if (!$positionValidation->exists($data["position"])) {
            throw new PositionNotFoundException($data["position"]);
        }
    }
}
