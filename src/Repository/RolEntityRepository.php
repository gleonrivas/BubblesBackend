<?php

namespace App\Repository;

use App\Entity\RolEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<RolEntity>
 * @method RolEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method RolEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method RolEntity[]    findAll()
 * @method RolEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RolEntityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RolEntity::class);
    }

    public function save(RolEntity $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(RolEntity $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
    public function findOneByIdentificador($descripcion): ?RolEntity
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.nombre = :val')
            ->setParameter('val', $descripcion)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }

    public function findOneByName(?string $nombre, EntityManager $entityManager): ?RolEntity{

        $rsm = new ResultSetMapping();
        $query = $entityManager->createNativeQuery('SELECT * FROM rol WHERE nombre = ? ', $rsm);
        $query->setParameter(1,$nombre);

        $rol = $query->getResult();
        return $rol;
    }


}
