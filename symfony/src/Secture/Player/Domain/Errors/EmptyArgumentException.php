<?php

namespace App\Secture\Player\Domain\Errors;

class EmptyArgumentException extends \RuntimeException implements \Throwable
{
    public function __construct(string $argument)
    {
        parent::__construct(sprintf("Player argument %s is empty", $argument), 400);
    }
}
