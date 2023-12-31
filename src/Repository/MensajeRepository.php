<?php

namespace App\Repository;

use App\Entity\Mensaje;
use App\Entity\Usuario;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\ResultSetMappingBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Mensaje>
 *
 * @method Mensaje|null find($id, $lockMode = null, $lockVersion = null)
 * @method Mensaje|null findOneBy(array $criteria, array $orderBy = null)
 * @method Mensaje[]    findAll()
 * @method Mensaje[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MensajeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Mensaje::class);
    }

    public function save(Mensaje $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Mensaje $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
    public function findChats( int $id_perfil): array
    {
        $rsm = new ResultSetMappingBuilder($this->getEntityManager());

        $rsm->addRootEntityFromClassMetadata('App\Entity\Perfil', 'p');


        $query = $this->getEntityManager()->createNativeQuery('SELECT DISTINCT receptor AS contacto FROM mensaje m WHERE emisor = ? UNION SELECT DISTINCT emisor AS contacto FROM mensaje m2 WHERE receptor = ?;', $rsm);
        $query->setParameter(1, $id_perfil);
        $chats = $query->getResult();

        return $chats;
    }





    public function findEmail($email)
    {
        $usuario = $this->findOneBy(['email' => $email]);
        return $usuario->getEmail();
    }

    public function findUsername(string $username)
    {
        $usuario = $this->findOneBy(['username' => $username]);
        return $usuario->getUsername();
    }

    public function eliminarEmisorMensajesPorIdPerfil( int $id_perfil)
    {
        $rsm = new ResultSetMappingBuilder($this->getEntityManager());

        $rsm->addRootEntityFromClassMetadata('App\Entity\Mensaje', 'l');

        $query = $this->getEntityManager()->createNativeQuery('DELETE FROM mensaje where emisor = ?', $rsm);
        $query->setParameter(1, $id_perfil);
        $query->execute();
        $this->getEntityManager()->flush();

    }
    public function eliminarReceptorMensajesPorIdPerfil( int $id_perfil)
    {
        $rsm = new ResultSetMappingBuilder($this->getEntityManager());

        $rsm->addRootEntityFromClassMetadata('App\Entity\Mensaje', 'l');

        $query = $this->getEntityManager()->createNativeQuery('DELETE FROM mensaje where receptor = ?', $rsm);
        $query->setParameter(1, $id_perfil);
        $query->execute();
        $this->getEntityManager()->flush();

    }
//    /**
//     * @return Mensaje[] Returns an array of Mensaje objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('m.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Mensaje
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
