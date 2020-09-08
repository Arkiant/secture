<?php

namespace App\Controller;

use App\Secture\Player\Application\PlayerCreator;
use App\Secture\Player\Infraestructure\DoctrinePlayerRepository;
use App\Secture\Player\Infraestructure\ExchangeRatesApiConvert;
use App\Secture\Team\Application\TeamCreator;
use App\Secture\Team\Infraestructure\DoctrineRepository;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class ApiController extends AbstractController
{

    private TeamCreator $teamcreator;
    private PlayerCreator $playercreator;

    public function getTeamCreator(): TeamCreator
    {
        $repository = new DoctrineRepository($this->getDoctrine());
        $this->teamcreator = new TeamCreator($repository);
        return $this->teamcreator;
    }

    public function getPlayerCreator(): PlayerCreator
    {
        $repository = new DoctrinePlayerRepository($this->getDoctrine());
        $converter = new ExchangeRatesApiConvert();
        $this->playercreator = new PlayerCreator($repository, $converter);
        return $this->playercreator;
    }

    public function success($response, $code = 200)
    {
        return $this->json(["message" => $response], $code);
    }

    public function fail(Exception $error)
    {
        $code = $error->getCode() ?: 500;
        $errorMessage = sprintf("An error ocurried: %s", $error->getMessage());

        return $this->json(["error" => $errorMessage], $code);
    }

    public function getData(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        return $data;
    }
}
