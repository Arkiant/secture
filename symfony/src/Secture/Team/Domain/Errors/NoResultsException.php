<?php

namespace App\Secture\Team\Domain\Errors;

class NoResultsException extends \RuntimeException implements \Throwable
{
    public function __construct()
    {
        parent::__construct(sprintf("No found teams"), 404);
    }
}
