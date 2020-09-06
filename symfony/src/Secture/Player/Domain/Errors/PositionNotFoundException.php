<?php

namespace App\Secture\Player\Domain\Errors;

class PositionNotFoundException extends \RuntimeException implements \Throwable
{
    public function __construct(string $position)
    {
        parent::__construct(sprintf("Position %s don't exists", $position), 400);
    }
}
