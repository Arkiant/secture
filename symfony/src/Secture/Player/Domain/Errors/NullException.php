<?php

namespace App\Secture\Player\Domain\Errors;

class NullException extends \RuntimeException implements \Throwable
{
    public function __construct()
    {
        parent::__construct(sprintf("Player can't be null"), 400);
    }
}
