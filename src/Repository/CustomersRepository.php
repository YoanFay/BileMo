<?php

namespace App\Repository;

use App\Entity\Customers;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;

/**
 * @extends ServiceEntityRepository<Customers>
 *
 * @method Customers|null find($id, $lockMode = null, $lockVersion = null)
 * @method Customers|null findOneBy(array $criteria, array $orderBy = null)
 * @method Customers[]    findAll()
 * @method Customers[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CustomersRepository extends ServiceEntityRepository
{
    /**
     * @param ManagerRegistry $registry parameter
     */
    public function __construct(ManagerRegistry $registry)
    {

        parent::__construct($registry, Customers::class);
    }


    /**
     * @param Customers $entity parameter
     * @param bool      $flush  parameter
     *
     * @return void
     */
    public function remove(Customers $entity, bool $flush = false): void
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
    public function findAllWithPagination($page, $limit)
    {

        return $this->createQueryBuilder('c')
            ->setFirstResult(($page - 1) * $limit)
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }


    /**
     * @param Customers $entity parameter
     * @param bool      $flush  parameter
     *
     * @return void
     */
    public function add(Customers $entity, bool $flush = false): void
    {

        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
