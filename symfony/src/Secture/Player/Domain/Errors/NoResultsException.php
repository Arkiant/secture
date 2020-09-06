<?php

namespace App\Secture\Player\Domain\Errors;

class NoResultsException extends \RuntimeException implements \Throwable
{
    public function __construct()
    {
        parent::__construct(sprintf("No results"), 404);
    }
}
