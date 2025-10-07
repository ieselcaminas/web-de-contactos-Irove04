<?php

namespace App\Repository;

use App\Entity\Contacto;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Contacto>
 */
class ContactoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Contacto::class);
    }

    public function findOneByName($text): array{
        $qb = $this->createQueryBuilder('c')
            ->andWhere('c.nombre LIKE :text')
            ->setParameter('text', '%'.$text.'%')
            ->getQuery();
        return $qb->getResult();
        }

    public function findByName($text): array
    {

        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery(
            'SELECT c FROM App\Entity\Contacto c WHERE c.nombre LIKE :text'
        )->setParameter('text', '%' . $text . '%');

        return $query->execute();
    }


    //    /**
    //     * @return Contacto[] Returns an array of Contacto objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('c.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Contacto
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
