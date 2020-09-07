<?php

namespace App\Secture\Team\Infraestructure;

use App\Entity\Team as DoctrineTeamEntity;
use App\Secture\Team\Domain\Team;
use App\Secture\Team\Domain\TeamID;
use App\Secture\Team\Domain\TeamRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\Persistence\ManagerRegistry;

class DoctrineRepository implements TeamRepository
{
    private EntityManager $em;

    public function __construct(ManagerRegistry $registry)
    {
        $this->em = $registry->getManager();
    }

    public function create(string $name): TeamID
    {
        $team = new DoctrineTeamEntity();
        $team->setName($name);
        $this->em->persist($team);
        $this->em->flush();

        return new TeamID($team->getId());
    }

    public function read(TeamID $id): ?Team
    {
        $team = $this->em->getRepository(DoctrineTeamEntity::class)->find($id->getID());
        if (!$team) {
            return null;
        }
        $responseTeam = new Team($team->getId(), $team->getName());
        return $responseTeam;
    }

    public function update(Team $team): ?Team
    {
        $teamEntity = $this->em->getRepository(DoctrineTeamEntity::class)->find($team->getID()->getID());
        if (!$teamEntity) {
            return null;
        }
        $teamEntity->setName($team->getName());
        $this->em->persist($teamEntity);
        $this->em->flush();
        return $team;
    }

    public function delete(TeamID $id): ?TeamID
    {

        $teamEntity = $this->em->getRepository(DoctrineTeamEntity::class)->find($id->getID());
        if (!$teamEntity) {
            return null;
        }
        $this->em->remove($teamEntity);
        $this->em->flush();
        return $id;
    }

    public function exists(string $name): bool
    {
        $teamEntity = $this->em->getRepository(DoctrineTeamEntity::class)->findBy(["name" => $name]);
        return !!$teamEntity;
    }

    public function findAll(): ?array
    {
        $teams = $this->em->getRepository(DoctrineTeamEntity::class)->findAll();
        if (!$teams) {
            return null;
        }

        $tList = [];
        foreach ($teams as $team) {
            array_push($tList, new Team($team->getId(), $team->getName()));
        }

        return $tList;
    }
}
