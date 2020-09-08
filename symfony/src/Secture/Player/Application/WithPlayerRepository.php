<?php

namespace App\Secture\Player\Application;

use App\Secture\Player\Domain\ConvertCurrency;
use App\Secture\Player\Domain\PlayerRepository;
use App\Secture\Team\Domain\TeamRepository;

/**
 * This class is used by use case class that use player repository 
 */
abstract class WithPlayerRepository
{
    private PlayerRepository $playerRepository;
    private TeamRepository $teamRepository;
    private ConvertCurrency $cc;

    public function __construct(PlayerRepository $playerRepository, TeamRepository $teamRepository, ConvertCurrency $converter)
    {
        $this->playerRepository = $playerRepository;
        $this->teamRepository = $teamRepository;
        $this->cc = $converter;
    }

    public function getPlayerRepository(): PlayerRepository
    {
        return $this->playerRepository;
    }

    public function getTeamRepository(): TeamRepository
    {
        return $this->teamRepository;
    }

    public function getConverter(): ConvertCurrency
    {
        return $this->cc;
    }
}
