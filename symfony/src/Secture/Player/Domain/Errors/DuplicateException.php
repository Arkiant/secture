<?php

namespace App\Secture\Player\Domain\Errors;

class DuplicateException extends \RuntimeException implements \Throwable
{
    public function __construct(string $name)
    {
        parent::__construct(sprintf("Player %s exists", $name), 400);
    }
}
