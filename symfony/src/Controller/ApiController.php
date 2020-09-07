<?php

namespace App\Controller;

use App\Secture\Player\Application\PlayerCreator;
use App\Secture\Player\Infraestructure\DoctrinePlayerRepository;
use App\Secture\Player\Infraestructure\ERAConvert;
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
        $converter = new ERAConvert();
        $this->playercreator = new PlayerCreator($repository, $converter);
        return $this->playercreator;
    }

    public function success($response)
    {
        return $this->json(["message" => $response]);
    }

    public function fail(Exception $error)
    {
        return $this->json(["error" => sprintf("An error ocurried: %s", $error->getMessage())], $error->getCode() | 500);
    }

    public function getData(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        return $data;
    }
}
