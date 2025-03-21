<?php

namespace App\Repository;

use App\Entity\Empilhadeira;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Empilhadeira>
 *
 * @method Empilhadeira|null find($id, $lockMode = null, $lockVersion = null)
 * @method Empilhadeira|null findOneBy(array $criteria, array $orderBy = null)
 * @method Empilhadeira[]    findAll()
 * @method Empilhadeira[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EmpilhadeiraRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Empilhadeira::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Empilhadeira $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(Empilhadeira $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return Empilhadeira[] Returns an array of Empilhadeira objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Empilhadeira
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
