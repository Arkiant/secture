<?php

namespace App\Controller;

use App\Secture\Api\Infraestructure\ApiController;
use App\Secture\Team\Domain\Team;
use App\Secture\Team\Domain\TeamID;
use Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class TeamController extends ApiController
{
    /**
     * @Route(
     *  "/team",
     *  condition="context.getMethod() in ['POST']"
     * )
     */
    public function create(Request $request)
    {
        try {
            $data = $this->getData($request);
            $teamID = $this->getTeamCreator()->create($data);
            return $this->success(sprintf("Successful created team with id: %s", $teamID->getID()));
        } catch (Exception $ex) {
            return $this->fail($ex);
        }
    }

    /**
     * @Route(
     * "/team/{id}",
     * requirements={"id"="\d+"},
     * condition="context.getMethod() in ['GET']"
     * )
     */
    public function read(int $id)
    {
        try {
            $team = $this->getTeamCreator()->read(new TeamID($id));
            return $this->success($team);
        } catch (Exception $ex) {
            return $this->fail($ex);
        }
    }

    /**
     * @Route(
     * "/team/{id}",
     * requirements={"id"="\d+"},
     * condition="context.getMethod() in ['PUT']"
     * )
     */
    public function update(Request $request, int $id)
    {
        try {
            $data = $this->getData($request);
            $updatedTeam = $this->getTeamCreator()->update(new Team($id, $data["name"]));
            $this->success($updatedTeam);
        } catch (Exception $ex) {
            return $this->fail($ex);
        }
    }

    /**
     * @Route(
     * "/team/{id}",
     * requirements={"id"="\d+"},
     * condition="context.getMethod() in ['DELETE']"
     * )
     */
    public function delete(int $id)
    {
        try {
            $deletedTeam = $this->getTeamCreator()->delete(new TeamID($id));
            $this->success(sprintf("Deleted team %d", $deletedTeam->getID()));
        } catch (Exception $ex) {
            return $this->fail($ex);
        }
    }
}
