<?php

namespace App\Secture\Player\Infraestructure;

use App\Entity\Player as EntityPlayer;
use App\Entity\Team as EntityTeam;
use App\Repository\PlayerRepository as RepositoryPlayerRepository;
use App\Secture\Player\Domain\PlayerRepository;
use App\Secture\Team\Domain\Team;
use App\Secture\Player\Domain\Player;
use Doctrine\ORM\EntityManager;
use Doctrine\Persistence\ManagerRegistry;

use function App\Secture\Team\Infraestructure\ConvertEntityTeamIntoTeam;

/**
 * Doctrine player concrete repository used to separate repository logic
 * from database implementation
 */
class DoctrinePlayerRepository implements PlayerRepository
{

    private EntityManager $em;

    public function __construct(ManagerRegistry $registry)
    {
        $this->em = $registry->getManager();
        $this->playerRepository = new RepositoryPlayerRepository($registry);
    }

    public function create(string $name, float $price, string $position, int $team): Player
    {
        $player = new EntityPlayer();
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
        $player = $this->em->getRepository(EntityPlayer::class)->find($id);
        if (!$player) {
            return null;
        }

        $responsePlayer = new Player($player->getId(), $player->getName(), $player->getPrice(), new Team($player->getTeam()->getId(), $player->getTeam()->getName()), $player->getPosition());

        return $responsePlayer;
    }

    public function update(Player $player): ?Player
    {

        $playerEntity = $this->em->getRepository(EntityPlayer::class)->find($player->getID());
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
        $playerEntity = $this->em->getRepository(EntityPlayer::class)->find($id);
        if (!$playerEntity) {
            return null;
        }
        $this->em->remove($playerEntity);
        $this->em->flush();
        return $id;
    }

    public function findAll(array $filters): ?array
    {
        $plist = [];
        $players = $this->em->getRepository(EntityPlayer::class)->findBy($filters);
        if (!$players) {
            return null;
        }
        foreach ($players as $player) {
            array_push($plist, ConvertEntityPlayerIntoPlayer($player));
        }
        return $plist;
    }

    public function exists(string $name): bool
    {
        $playerEntity = $this->em->getRepository(EntityPlayer::class)->findBy(["name" => $name]);
        return !!$playerEntity;
    }
}

/**
 * Convert entity player into a player domain, this is necessary because are different types and we need to separate domain from database entity
 * 
 * @param EntityPlayer $entityPlayer
 * @return Player
 */
function ConvertEntityPlayerIntoPlayer(EntityPlayer $entityPlayer): Player
{
    return new Player($entityPlayer->getId(), $entityPlayer->getName(), $entityPlayer->getPrice(), ConvertEntityTeamIntoTeam($entityPlayer->getTeam()), $entityPlayer->getPosition());
}
