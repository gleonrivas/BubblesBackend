<?php

namespace App\Repository;

use App\Entity\Comentarios;
use App\Entity\Usuario;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\ResultSetMappingBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Comentarios>
 *
 * @method Comentarios|null find($id, $lockMode = null, $lockVersion = null)
 * @method Comentarios|null findOneBy(array $criteria, array $orderBy = null)
 * @method Comentarios[]    findAll()
 * @method Comentarios[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ComentarioRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Comentarios::class);
    }

    public function save(Comentarios $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Comentarios $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function listarPorLikesYpublicacion(int $id_publicacion): array
    {
        $rsm = new ResultSetMappingBuilder($this->getEntityManager());

        $rsm->addRootEntityFromClassMetadata('App\Entity\Comentarios', 'c');

        $query = $this->getEntityManager()->createNativeQuery('select c.* from likes l 
                                                                join comentarios c on l.id_comentario = c.id 
                                                                join publicacion p on l.id_publicacion = p.id
                                                                where p.id = ? group by c.id order by count(l.id_comentario) desc', $rsm);
        $query->setParameter(1, $id_publicacion);
        $comentarios = $query->getResult();
        $comentario = $comentarios[0];

        return $comentarios;
    }

//    /**
//     * @return Comentario[] Returns an array of Comentario objects
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

//    public function findOneBySomeField($value): ?Comentario
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
