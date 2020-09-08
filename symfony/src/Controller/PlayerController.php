<?php

namespace App\Controller;

use Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PlayerController extends ApiController
{
    /**
     * @Route(
     *  "/player",
     *  condition="context.getMethod() in ['POST']"
     * )
     */
    public function create(Request $request)
    {
        try {
            $data = $this->getData($request);
            $playerID = $this->getPlayerCreator()->create($data);
            return $this->success(sprintf("Successful created player with id: %s", $playerID), Response::HTTP_CREATED);
        } catch (Exception $ex) {
            return $this->fail($ex);
        }
    }

    /**
     * @Route(
     * "/player/{id}",
     * requirements={"id"="\d+"},
     * condition="context.getMethod() in ['GET']"
     * )
     */
    public function read(Request $request, int $id)
    {
        try {
            $currency = $request->query->get("currency");
            $team = $this->getPlayerCreator()->read($id, $currency);
            return $this->success($team);
        } catch (Exception $ex) {
            return $this->fail($ex);
        }
    }

    /**
     * @Route(
     * "/player/{id}",
     * requirements={"id"="\d+"},
     * condition="context.getMethod() in ['PUT']"
     * )
     */
    public function update(Request $request, int $id)
    {
        try {
            $data = $this->getData($request);
            $updatedPlayer = $this->getPlayerCreator()->update($data, $id);
            return $this->success($updatedPlayer);
        } catch (Exception $ex) {
            return $this->fail($ex);
        }
    }

    /**
     * @Route(
     * "/player/{id}",
     * requirements={"id"="\d+"},
     * condition="context.getMethod() in ['DELETE']"
     * )
     */
    public function delete(int $id)
    {
        try {
            $deletedPlayer = $this->getPlayerCreator()->delete($id);
            return $this->success(sprintf("Deleted player %d", $deletedPlayer));
        } catch (Exception $ex) {
            return $this->fail($ex);
        }
    }

    /**
     * @Route(
     *  "/player",
     *  condition="context.getMethod() in ['GET']"
     * )
     */
    public function getAll(Request $request)
    {

        try {
            $teamFilter = $request->query->get('team');
            $positionFilter = $request->query->get("position");
            $currency = $request->query->get("currency");
            $players = $this->getPlayerCreator($currency)->getAll($teamFilter, $positionFilter, $currency);

            return $this->success($players);
        } catch (Exception $ex) {
            return $this->fail($ex);
        }
    }
}
