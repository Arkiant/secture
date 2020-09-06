<?php

namespace App\Secture\Team\Domain\Errors;

class NullException extends \RuntimeException implements \Throwable
{
    public function __construct()
    {
        parent::__construct(sprintf("Team can't be null"), 400);
    }
}
