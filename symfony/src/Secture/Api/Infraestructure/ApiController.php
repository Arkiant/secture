<?php

namespace App\Secture\Api\Infraestructure;

use App\Secture\Team\Application\TeamCreator;
use App\Secture\Player\Infraestructure\DoctrineTeamRepository;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class ApiController extends AbstractController
{


    private $teamcreator;

    public function getTeamCreator(): TeamCreator
    {
        if ($this->teamcreator == null) {
            $repository = new DoctrineTeamRepository($this->getDoctrine());
            $this->teamcreator = new TeamCreator($repository);
            return $this->teamcreator;
        } else {
            return $this->teamcreator;
        }
    }

    public function success($response)
    {
        return $this->json(["message" => $response]);
    }

    public function fail(Exception $error)
    {
        return $this->json(["error" => sprintf("An error ocurried: %s", $error->getMessage())], $error->getCode());
    }

    public function getData(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        return $data;
    }
}
