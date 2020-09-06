<?php

namespace App\Secture\Team\Domain\Errors;

class EmptyArgumentException extends \RuntimeException implements \Throwable
{
    public function __construct(string $argument)
    {
        parent::__construct(sprintf("Team argument %s is empty", $argument), 400);
    }
}
