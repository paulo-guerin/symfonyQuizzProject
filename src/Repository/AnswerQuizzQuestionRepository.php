<?php

namespace App\Repository;

use App\Entity\AnswerQuizzQuestion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AnswerQuizzQuestion|null find($id, $lockMode = null, $lockVersion = null)
 * @method AnswerQuizzQuestion|null findOneBy(array $criteria, array $orderBy = null)
 * @method AnswerQuizzQuestion[]    findAll()
 * @method AnswerQuizzQuestion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AnswerQuizzQuestionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AnswerQuizzQuestion::class);
    }

    // /**
    //  * @return AnswerQuizzQuestion[] Returns an array of AnswerQuizzQuestion objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AnswerQuizzQuestion
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
