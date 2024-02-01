<?php

namespace App\Repository;

use App\Entity\Phones;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Phones>
 *
 * @method Phones|null find($id, $lockMode = null, $lockVersion = null)
 * @method Phones|null findOneBy(array $criteria, array $orderBy = null)
 * @method Phones[]    findAll()
 * @method Phones[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PhonesRepository extends ServiceEntityRepository
{
    /**
     * @param ManagerRegistry $registry parameter
     */
    public function __construct(ManagerRegistry $registry)
    {

        parent::__construct($registry, Phones::class);
    }


    /**
     * @param Phones $entity parameter
     * @param bool   $flush  parameter
     *
     * @return void
     */
    public function add(Phones $entity, bool $flush = false): void
    {

        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }


    /**
     * @param Phones $entity parameter
     * @param bool   $flush  parameter
     *
     * @return void
     */
    public function remove(Phones $entity, bool $flush = false): void
    {

        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }


    /**
     * @param int $page  parameter
     * @param int $limit parameter
     *
     * @return float|int|mixed|string
     */
    public function findAllWithPagination(int $page, int $limit)
    {

        return $this->createQueryBuilder('p')
            ->setFirstResult(($page - 1) * $limit)
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }
}
