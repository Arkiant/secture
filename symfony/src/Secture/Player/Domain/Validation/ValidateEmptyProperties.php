<?php

namespace App\Secture\Player\Domain\Validation;

class ValidateEmptyProperties
{
    private static $notEmptyValues = ["name", "price", "team", "position"];

    /**
     * Validate empty properties
     * 
     * @param array $data ["name" => "test", "price" => 400, "position" => "goalkeeper", "team" => 5]
     * 
     * @return array ["result" => bool, "values" => []]
     * 
     * values is an array of empty properties
     */
    public static function validate(array $data): array
    {
        $empty = array_filter($data, function ($v, $k) {
            return (array_search($k, self::$notEmptyValues) !== FALSE && empty($v));
        }, ARRAY_FILTER_USE_BOTH);

        return ["result" => !(count($empty) > 0), "values" => array_keys($empty)];
    }
}
