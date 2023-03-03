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

    public function editar(string $username,string $descripcion,string $foto_perfil, string $tipo_cuenta, int $id_perfil)
    {
        $rsm = new ResultSetMappingBuilder($this->getEntityManager());
        $rsm->addRootEntityFromClassMetadata('App\Entity\Perfil', 'p');

        $query = $this->getEntityManager()->createNativeQuery('update perfil set username = ? , descripcion  = ? ,foto_perfil  = ?, tipo_cuenta  = ? where id = ?', $rsm);
        $query->setParameter(1, $username);
        $query->setParameter(2, $descripcion);
        $query->setParameter(3, $foto_perfil);
        $query->setParameter(4, $tipo_cuenta);
        $query->setParameter(5, $id_perfil);
        $query->execute();

    }

    public function insertarCarpeta(string $carpeta, int $id)
    {
        $rsm = new ResultSetMappingBuilder($this->getEntityManager());
        $rsm->addRootEntityFromClassMetadata('App\Entity\Perfil', 'p');

        $query = $this->getEntityManager()->createNativeQuery('update perfil set carpeta = ? where id = ?', $rsm);
        $query->setParameter(1, $carpeta);
        $query->setParameter(2, $id);
        $query->execute();

    }

    public function encontrarPorUsername( string $username): array
    {
        $rsm = new ResultSetMappingBuilder($this->getEntityManager());

        $rsm->addRootEntityFromClassMetadata('App\Entity\Perfil', 'p');

        $query = $this->getEntityManager()->createNativeQuery('SELECT * FROM perfil WHERE username like ? LIMIT 1', $rsm);
        $query->setParameter(1, $username);
        $perfiles = $query->getResult();


        return $perfiles;
    }

    public function eliminarperfilPorIdPerfil( int $id_perfil)
    {
        $rsm = new ResultSetMappingBuilder($this->getEntityManager());

        $rsm->addRootEntityFromClassMetadata('App\Entity\Perfil', 'p');

        $query = $this->getEntityManager()->createNativeQuery('DELETE FROM perfil * where id = ?', $rsm);
        $query->setParameter(1, $id_perfil);
        $query->execute();
        $this->getEntityManager()->flush();

    }


    public function getByUsername(string $username){
        $rsm = new ResultSetMappingBuilder($this->getEntityManager());

        $rsm->addRootEntityFromClassMetadata('App\Entity\Perfil', 'p');

        $query = $this->getEntityManager()->createNativeQuery('SELECT * FROM perfil WHERE username like ? order by username desc LIMIT 10', $rsm);
        $query->setParameter(1, $username.'%');
        $perfiles = $query->getResult();


        return $perfiles;

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
