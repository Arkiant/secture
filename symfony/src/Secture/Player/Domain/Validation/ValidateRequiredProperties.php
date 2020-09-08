<?php

namespace App\Secture\Player\Domain\Validation;

class ValidateRequiredProperties
{

    private static $requiredValues = ["name", "price", "team", "position"];

    /**
     * Validate required properties
     * 
     * @param array $data ["name" => "test", "price" => 400, "position" => "goalkeeper", "team" => 5]
     * 
     * @return array ["result" => bool, "values" => []]
     * 
     * values is an array of required properties
     */
    public static function validate(array $data): array
    {
        $values = array_diff(self::$requiredValues, array_keys($data));
        return ["result" => !(count($values) > 0), "values" => $values];
    }
}
