<?php

namespace App\Secture\Player\Domain\Errors;

use App\Secture\Player\Domain\Player;

class NotFoundException extends \RuntimeException implements \Throwable
{
    public function __construct(int $id)
    {
        parent::__construct(sprintf("Player not found %s", $id), 404);
    }
}
