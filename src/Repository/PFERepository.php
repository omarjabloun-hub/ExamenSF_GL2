<?php

namespace App\Repository;

use App\Entity\PFE;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PFE>
 *
 * @method PFE|null find($id, $lockMode = null, $lockVersion = null)
 * @method PFE|null findOneBy(array $criteria, array $orderBy = null)
 * @method PFE[]    findAll()
 * @method PFE[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PFERepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PFE::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(PFE $entity, bool $flush = false): void
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
    public function remove(PFE $entity, bool $flush = false): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    public function PfeGroupedByEntreprise(int $lim , int $off): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = "
                SELECT designation , count(entreprise_id) as nbEnt  FROM pfe
                                                             INNER JOIN entreprise ON entreprise_id = entreprise.id
GROUP BY entreprise_id
ORDER BY designation ASC
LIMIT $lim  OFFSET $off ;
                ;
             ";
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        // returns an array of arrays (i.e. a raw data set)
        return $resultSet->fetchAllAssociative();
    }
//    /**
//     * @return PFE[] Returns an array of PFE objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?PFE
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
