<?php

namespace App\Secture\Player\Infraestructure;

use App\Entity\Player as DoctrinePlayerEntity;
use App\Entity\Team as EntityTeam;
use App\Repository\PlayerRepository as RepositoryPlayerRepository;
use App\Secture\Player\Domain\PlayerRepository;
use App\Secture\Team\Domain\Team;
use App\Secture\Player\Domain\Player;
use Doctrine\ORM\EntityManager;
use Doctrine\Persistence\ManagerRegistry;
use Exception;

class DoctrinePlayerRepository implements PlayerRepository
{

    private EntityManager $em;
    private RepositoryPlayerRepository $playerRepository;

    public function __construct(ManagerRegistry $registry)
    {
        $this->em = $registry->getManager();
        $this->playerRepository = new RepositoryPlayerRepository($registry);
    }

    public function create(string $name, float $price, string $position, int $team): Player
    {
        $player = new DoctrinePlayerEntity();
        $player->setName($name);
        $player->setPrice($price);
        $player->setPosition($position);
        $team = $this->em->getRepository(EntityTeam::class)->find($team);

        $player->setTeam($team);
        $this->em->persist($player);
        $this->em->flush();
        return new Player($player->getId(), $player->getName(), $player->getPrice(), new Team($team->getId(), $team->getName()), $player->getPosition());
    }

    public function read(int $id): ?Player
    {
        $player = $this->em->getRepository(DoctrinePlayerEntity::class)->find($id);
        if (!$player) {
            return null;
        }

        $responsePlayer = new Player($player->getId(), $player->getName(), $player->getPrice(), new Team($player->getTeam()->getId(), $player->getTeam()->getName()), $player->getPosition());

        return $responsePlayer;
    }

    public function update(Player $player): ?Player
    {

        $playerEntity = $this->em->getRepository(DoctrinePlayerEntity::class)->find($player->getID());
        if (!$playerEntity) {
            return null;
        }
        $playerEntity->setName($player->getName());
        $playerEntity->setPrice($player->getPrice());
        $playerEntity->setPosition($player->getPosition());

        $team = $this->em->getRepository(EntityTeam::class)->find($player->GetTeam()->GetID()->getID());

        $playerEntity->setTeam($team);
        $this->em->persist($playerEntity);
        $this->em->flush();
        $player->SetTeam(new Team($team->getId(), $team->getName()));
        return $player;
    }

    public function delete(int $id): ?int
    {
        $playerEntity = $this->em->getRepository(DoctrinePlayerEntity::class)->find($id);
        if (!$playerEntity) {
            return null;
        }
        $this->em->remove($playerEntity);
        $this->em->flush();
        return $id;
    }

    /**
     * FIXME: don't receive nothing from database
     */
    public function getByPosition(string $position): ?array
    {

        $result = $this->playerRepository->findByPosition($position);
        if (!$result) {
            return null;
        }

        return $result;
    }

    /**
     * FIXME: don't receive nothing from database
     */
    public function findAll()
    {
        $result = $this->em->getRepository(DoctrinePlayerEntity::class)->findAll();
        return $result;
    }

    public function exists(string $name): bool
    {
        $playerEntity = $this->em->getRepository(DoctrinePlayerEntity::class)->findBy(["name" => $name]);
        return !!$playerEntity;
    }
}
