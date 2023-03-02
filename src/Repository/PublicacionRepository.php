<?php

namespace App\Repository;

use App\Entity\Publicacion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\ResultSetMappingBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Publicacion>
 *
 * @method Publicacion|null find($id, $lockMode = null, $lockVersion = null)
 * @method Publicacion|null findOneBy(array $criteria, array $orderBy = null)
 * @method Publicacion[]    findAll()
 * @method Publicacion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PublicacionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Publicacion::class);
    }

    public function save(Publicacion $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }


    }

    public function remove(Publicacion $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }


    public function findPublicacionesConLikes(int $id_perfil): array
    {
        $rsm = new ResultSetMappingBuilder($this->getEntityManager());

        $rsm->addRootEntityFromClassMetadata('App\Entity\Publicacion', 'p');

        $query = $this->getEntityManager()->createNativeQuery('select p.* from likes l
                                                                join publicacion p on l.id_publicacion = p.id
                                                                where l.id_perfil = ? ', $rsm);
        $query->setParameter(1, $id_perfil);
        $publicaciones = $query->getResult();

        return $publicaciones;


    }

    public function tematicaPorLikes(int $id_perfil): array
    {
        $rsm = new ResultSetMappingBuilder($this->getEntityManager());

        $rsm->addRootEntityFromClassMetadata('App\Entity\Publicacion', 'p');
        $rsm->addFieldResult('p', 'tematica', 'tematica');


        $query = $this->getEntityManager()->createNativeQuery('SELECT p.* FROM publicacion p
                                                         JOIN likes l ON l.id_publicacion = p.id
                                                         JOIN perfil p2 ON l.id_perfil = p2.id 
                                                         WHERE l.id_perfil = ?', $rsm);

        $query->setParameter(1, $id_perfil);
        $publicaciones = $query->getResult();


        $tematicas = [];
        foreach ($publicaciones as $publicacion) {
            array_push($tematicas, $publicacion->getTematica());
        }


        return $tematicas;


    }
    public function eliminarPublicacionPorIdPerfil( int $id_perfil)
    {
        $rsm = new ResultSetMappingBuilder($this->getEntityManager());

        $rsm->addRootEntityFromClassMetadata('App\Entity\Publicacion', 'p');

        $query = $this->getEntityManager()->createNativeQuery('DELETE FROM publicacion * where id_perfil = ?', $rsm);
        $query->setParameter(1, $id_perfil);
        $query->execute();
        $this->getEntityManager()->flush();

    }


//    /**
//     * @return Publicacion[] Returns an array of Publicacion objects
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

//    public function findOneBySomeField($value): ?Publicacion
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
