<?php

namespace App\Secture\Player\Domain;

interface ConvertCurrency
{
    public function convert(Player $player, ?string $currency): Player;
}
