<?php

namespace App\Secture\Player\Application;

use App\Secture\Player\Domain\ConvertCurrency;
use App\Secture\Player\Domain\PlayerRepository;

/**
 * This class is used by use case class that use player repository 
 */
abstract class WithPlayerRepository
{
    private PlayerRepository $repository;
    private ConvertCurrency $cc;

    public function __construct(PlayerRepository $playerRepository, ConvertCurrency $converter)
    {
        $this->repository = $playerRepository;
        $this->cc = $converter;
    }

    public function getRepository(): PlayerRepository
    {
        return $this->repository;
    }

    public function getConverter(): ConvertCurrency
    {
        return $this->cc;
    }
}
