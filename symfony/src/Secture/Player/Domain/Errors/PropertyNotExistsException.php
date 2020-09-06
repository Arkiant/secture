<?php

namespace App\Secture\Player\Domain\Errors;

class PropertyNotExistsException extends \RuntimeException implements \Throwable
{
    public function __construct(string $argument)
    {
        parent::__construct(sprintf("Player property %s don't exists", $argument), 400);
    }
}
