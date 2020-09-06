<?php

namespace App\Repository;

use App\Entity\Player;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Player|null find($id, $lockMode = null, $lockVersion = null)
 * @method Player|null findOneBy(array $criteria, array $orderBy = null)
 * @method Player[]    findAll()
 * @method Player[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlayerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Player::class);
    }

    public function findByTeam($team)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.team = :val')
            ->setParameter('val', $team)
            ->getQuery()
            ->getResult();
    }

    public function findByPosition($position)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.position = :val')
            ->setParameter('val', '%' . $position . '%')
            ->getQuery()
            ->getResult();
    }

    public function findByTeamAndPosition($team, $position)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.team = :team')
            ->andWhere('p.position = :position')
            ->setParameter('team', $team)
            ->setParameter('position', $position)
            ->getQuery()
            ->getResult();
    }
}
