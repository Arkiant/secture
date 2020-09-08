<?php

namespace App\Secture\Team\Domain\Errors;

class DuplicateException extends \RuntimeException implements \Throwable
{
    public function __construct(string $name)
    {
        parent::__construct(sprintf("Team %s exists", $name), 409);
    }
}
