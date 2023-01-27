<?php

namespace App\Repository;

use App\Entity\Perfil;
use App\Entity\RolEntity;
use App\Entity\Usuario;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\ORM\Query\ResultSetMappingBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Perfil>
 *
 * @method Perfil|null find($id, $lockMode = null, $lockVersion = null)
 * @method Perfil|null findOneBy(array $criteria, array $orderBy = null)
 * @method Perfil[]    findAll()
 * @method Perfil[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PerfilRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Perfil::class);
    }

    public function save(Perfil $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Perfil $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function encontrarporId( int $id_perfil): Perfil
    {
        $rsm = new ResultSetMappingBuilder($this->getEntityManager());

        $rsm->addRootEntityFromClassMetadata('App\Entity\Perfil', 'p');
        $rsm->addFieldResult('p', 'id', 'id');
        $rsm->addFieldResult('p', 'descripcion', 'descripcion');
        $rsm->addFieldResult('p', 'username', 'username');
        $rsm->addFieldResult('p', 'tipo_cuenta', 'tipo_cuenta');
        $rsm->addFieldResult('p', 'foto_perfil', 'foto_perfil');
        $rsm->addMetaResult('p', 'id_usuario', 'id_usuario');

        $query = $this->getEntityManager()->createNativeQuery('SELECT * FROM perfil WHERE id=? LIMIT 1', $rsm);
        $query->setParameter(1, $id_perfil);
        $perfiles = $query->getResult();
        $perfil = $perfiles[0];

        $repository = $this->getEntityManager()->getRepository('App\Entity\Perfil');
        $perfiles = $repository->findBy(['id' => $id_perfil] );

        return $perfil;
    }


//    /**
//     * @return Perfil[] Returns an array of Perfil objects
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

//    public function findOneBySomeField($value): ?Perfil
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }




}