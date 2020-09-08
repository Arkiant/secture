<?php

namespace App\Controller;

use App\Secture\Team\Domain\Team;
use App\Secture\Team\Domain\TeamID;
use Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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
            return $this->success(sprintf("Successful created team with id: %s", $teamID), Response::HTTP_CREATED);
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
            return $this->success($updatedTeam);
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
            $teamID = $this->getTeamCreator()->delete(new TeamID($id));
            return $this->success(sprintf("Deleted team %d", $teamID));
        } catch (Exception $ex) {
            return $this->fail($ex);
        }
    }

    /**
     * @Route(
     *  "/team",
     *  condition="context.getMethod() in ['GET']"
     * )
     */
    public function getAll(Request $request)
    {

        try {
            $players = $this->getTeamCreator()->getAll();
            return $this->success($players);
        } catch (Exception $ex) {
            return $this->fail($ex);
        }
    }
}
