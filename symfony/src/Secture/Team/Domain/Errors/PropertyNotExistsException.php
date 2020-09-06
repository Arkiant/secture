<?php

namespace App\Secture\Team\Domain\Errors;

class PropertyNotExistsException extends \RuntimeException implements \Throwable
{
    public function __construct(string $argument)
    {
        parent::__construct(sprintf("Team property %s don't exists", $argument), 400);
    }
}
