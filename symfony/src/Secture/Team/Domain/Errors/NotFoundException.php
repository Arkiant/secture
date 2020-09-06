<?php

namespace App\Secture\Team\Domain\Errors;

use App\Secture\Team\Domain\TeamID;

class NotFoundException extends \RuntimeException implements \Throwable
{
    public function __construct(TeamID $teamID)
    {
        parent::__construct(sprintf("Team not found %s", $teamID->getID()), 404);
    }
}
