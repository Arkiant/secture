<?php

namespace App\Secture\Team\Domain\Errors;

class NotFoundException extends \RuntimeException implements \Throwable
{
    public function __construct(int $teamID)
    {
        parent::__construct(sprintf("Team not found %s", $teamID), 404);
    }
}
