<?php

namespace App\Repository;

use App\Entity\Seguidor;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\ResultSetMappingBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Seguidor>
 *
 * @method Seguidor|null find($id, $lockMode = null, $lockVersion = null)
 * @method Seguidor|null findOneBy(array $criteria, array $orderBy = null)
 * @method Seguidor[]    findAll()
 * @method Seguidor[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SeguidorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Seguidor::class);
    }

    public function save(Seguidor $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Seguidor $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function eliminarSeguidorPorIdPerfil( int $id_perfil)
    {
        $rsm = new ResultSetMappingBuilder($this->getEntityManager());

        $rsm->addRootEntityFromClassMetadata('App\Entity\Seguidor', 's');

        $query = $this->getEntityManager()->createNativeQuery('DELETE FROM seguidor * where id_follower = ?', $rsm);
        $query->setParameter(1, $id_perfil);
        $this->getEntityManager()->flush();

    }
    public function eliminarSeguidoPorIdPerfil( int $id_perfil)
    {
        $rsm = new ResultSetMappingBuilder($this->getEntityManager());

        $rsm->addRootEntityFromClassMetadata('App\Entity\Seguidor', 's');

        $query = $this->getEntityManager()->createNativeQuery('DELETE FROM seguidor * where id_principal = ?', $rsm);
        $query->setParameter(1, $id_perfil);
        $this->getEntityManager()->flush();

    }

/**
//     * @return Seguidor[] Returns an array of Seguidor objects
//     */
public function buscarSeguidorPorIdPrincipal(int $id_principal): array
{
    $rsm = new ResultSetMappingBuilder($this->getEntityManager());

    $rsm->addRootEntityFromClassMetadata('App\Entity\Seguidor', 's');
    $rsm->addFieldResult('s', 'id_principal', 'id_principal');

    $query = $this->getEntityManager()->createNativeQuery('SELECT * FROM seguidor WHERE id_principal=?', $rsm);
    $query->setParameter(1, $id_principal);
    $seguidores = $query->getResult();

 return $seguidores;
}

//    public function findOneBySomeField($value): ?Seguidor
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
