<?php

namespace App\Secture\Team\Infraestructure;

use App\Entity\Team as EntityTeam;
use App\Secture\Team\Domain\Team;
use App\Secture\Team\Domain\TeamID;
use App\Secture\Team\Domain\TeamRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Doctrine team concrete repository used to separate repository logic from database implementation
 */
class DoctrineRepository implements TeamRepository
{
    private EntityManager $em;

    public function __construct(ManagerRegistry $registry)
    {
        $this->em = $registry->getManager();
    }

    public function create(string $name): TeamID
    {
        $team = new EntityTeam();
        $team->setName($name);
        $this->em->persist($team);
        $this->em->flush();

        return new TeamID($team->getId());
    }

    public function read(TeamID $id): ?Team
    {
        $team = $this->em->getRepository(EntityTeam::class)->find($id->getID());
        if (!$team) {
            return null;
        }
        $responseTeam = new Team($team->getId(), $team->getName());
        return $responseTeam;
    }

    public function update(Team $team): ?Team
    {
        $teamEntity = $this->em->getRepository(EntityTeam::class)->find($team->getID()->getID());
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

        $teamEntity = $this->em->getRepository(EntityTeam::class)->find($id->getID());
        if (!$teamEntity) {
            return null;
        }
        $this->em->remove($teamEntity);
        $this->em->flush();
        return $id;
    }

    public function exists(string $name): bool
    {
        $teamEntity = $this->em->getRepository(EntityTeam::class)->findBy(["name" => $name]);
        return !!$teamEntity;
    }

    public function findAll(): ?array
    {
        $teams = $this->em->getRepository(EntityTeam::class)->findAll();
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

/**
 * Convert a entity team into a team, this is necessary because are different types and we need to separate domain from database entity
 * 
 * @param EntityTeam $entityTeam
 * @return Team
 */
function ConvertEntityTeamIntoTeam(EntityTeam $entityTeam): Team
{
    return new Team($entityTeam->getId(), $entityTeam->getName());
}
