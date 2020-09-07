<?php

namespace App\Secture\Player\Infraestructure;

use App\Secture\Player\Domain\ConvertCurrency;
use App\Secture\Player\Domain\Player;

class ERAConvert implements ConvertCurrency
{
    public function convert(Player $player, ?string $currency): Player
    {
        if (is_null($currency)) {
            return $player;
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.exchangeratesapi.io/latest");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
        if ($data) {
            $decoded = json_decode($data, true);
            $conversion = $decoded["rates"][strtoupper($currency)];
            $player->SetPrice($player->GetPrice() * $conversion);
        }
        curl_close($ch);
        return $player;
    }
}
