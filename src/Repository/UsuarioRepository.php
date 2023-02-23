<?php

namespace App\Repository;

use App\Entity\Usuario;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query\ResultSetMappingBuilder;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\ORM\EntityManagerInterface;
use PhpParser\Node\Scalar\String_;

/**
 * @extends ServiceEntityRepository<Usuario>
 *
 * @method Usuario|null find($id, $lockMode = null, $lockVersion = null)
 * @method Usuario|null findOneBy(array $criteria, array $orderBy = null)
 * @method Usuario[]    findAll()
 * @method Usuario[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UsuarioRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Usuario::class);
    }


    public function save(Usuario $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Usuario $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function encontrarporId( int $id_usuario): Usuario
    {
        $rsm = new ResultSetMappingBuilder($this->getEntityManager());

        $rsm->addRootEntityFromClassMetadata('App\Entity\Usuario', 'u');
        $rsm->addFieldResult('u', 'id', 'id');
        $rsm->addFieldResult('u', 'nombre', 'nombre');

        $query = $this->getEntityManager()->createNativeQuery('SELECT * FROM usuario WHERE id=? LIMIT 1', $rsm);
        $query->setParameter(1, $id_usuario);
        $usuarios = $query->getResult();
        $usuario = $usuarios[0];

        return $usuario;
    }

    public function encontrarporEmail( string $email): array
    {
        $rsm = new ResultSetMappingBuilder($this->getEntityManager());

        $rsm->addRootEntityFromClassMetadata('App\Entity\Usuario', 'u');
        $rsm->addFieldResult('u', 'id', 'id');
        $rsm->addFieldResult('u', 'nombre', 'nombre');

        $query = $this->getEntityManager()->createNativeQuery('SELECT * FROM usuario WHERE email = ? LIMIT 1', $rsm);
        $query->setParameter(1, $email);
        $usuarios = $query->getResult();

        return $usuarios;
    }

    public function editar(string $nombre,string $telefono,string $apellidos, string $email, string $contrasena, \DateTimeInterface $fecha_nacimiento, int $id_usuario)
    {
        $rsm = new ResultSetMappingBuilder($this->getEntityManager());

        $rsm->addRootEntityFromClassMetadata('App\Entity\Usuario', 'u');

        $query = $this->getEntityManager()->createNativeQuery('update usuario set nombre = ? , apellidos = ? ,telefono = ?, email = ?, contrasena = ?, fecha_nacimiento = ? where id = ?', $rsm);
        $query->setParameter(1, $nombre);
        $query->setParameter(2, $apellidos);
        $query->setParameter(3, $telefono);
        $query->setParameter(4, $email);
        $query->setParameter(5, $contrasena);
        $query->setParameter(6, $fecha_nacimiento);
        $query->setParameter(7, $id_usuario);
        $usuarios = $query->execute();

    }


//    /**
//     * @return Usuario[] Returns an array of Usuario objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('u.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Usuario
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }


}