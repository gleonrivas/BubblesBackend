<?php

namespace ContainerKPMG08o;


use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class get_ServiceLocator_XoxaVuqService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.service_locator.XoxaVuq' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.XoxaVuq'] = new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService, [
            'App\\Controller\\ComentarioController::listar' => ['privates', '.service_locator.kz6ZuBB', 'get_ServiceLocator_Kz6ZuBBService', true],
            'App\\Controller\\LikeController::cantidadlikesdeComentario' => ['privates', '.service_locator.q1Amhe4', 'get_ServiceLocator_Q1Amhe4Service', true],
            'App\\Controller\\LikeController::cantidadlikesdePublicacion' => ['privates', '.service_locator.q1Amhe4', 'get_ServiceLocator_Q1Amhe4Service', true],
            'App\\Controller\\LikeController::eliminarlikepublicacion' => ['privates', '.service_locator.tncbWWT', 'get_ServiceLocator_TncbWWTService', true],
            'App\\Controller\\LikeController::guardarLikeComentario' => ['privates', '.service_locator.txLU3I6', 'get_ServiceLocator_TxLU3I6Service', true],
            'App\\Controller\\LikeController::guardarLikePublicacion' => ['privates', '.service_locator.VQrjO0l', 'get_ServiceLocator_VQrjO0lService', true],
            'App\\Controller\\LikeController::listarlikesdeComentario' => ['privates', '.service_locator.ICgUdJx', 'get_ServiceLocator_ICgUdJxService', true],
            'App\\Controller\\LikeController::listarlikesdePublicacion' => ['privates', '.service_locator.ICgUdJx', 'get_ServiceLocator_ICgUdJxService', true],
            'App\\Controller\\LoginController::login' => ['privates', '.service_locator.CGq8rmw', 'get_ServiceLocator_CGq8rmwService', true],
            'App\\Controller\\PerfilController::editar' => ['privates', '.service_locator.kqFTv_Y', 'get_ServiceLocator_KqFTvYService', true],
            'App\\Controller\\PerfilController::eliminar' => ['privates', '.service_locator.kqFTv_Y', 'get_ServiceLocator_KqFTvYService', true],
            'App\\Controller\\PerfilController::listar' => ['privates', '.service_locator.5NPK3Ls', 'get_ServiceLocator_5NPK3LsService', true],
            'App\\Controller\\PerfilController::listarPorNombre' => ['privates', '.service_locator.5NPK3Ls', 'get_ServiceLocator_5NPK3LsService', true],
            'App\\Controller\\PerfilController::listarPorUsuario' => ['privates', '.service_locator.5NPK3Ls', 'get_ServiceLocator_5NPK3LsService', true],
            'App\\Controller\\PerfilController::save' => ['privates', '.service_locator.JcVzCu4', 'get_ServiceLocator_JcVzCu4Service', true],
            'App\\Controller\\PublicacionController::editarPublicacion' => ['privates', '.service_locator.jdCOyR4', 'get_ServiceLocator_JdCOyR4Service', true],
            'App\\Controller\\PublicacionController::eliminarPublicacion' => ['privates', '.service_locator.6rnaC2K', 'get_ServiceLocator_6rnaC2KService', true],
            'App\\Controller\\PublicacionController::guardarPublicacion' => ['privates', '.service_locator.jdCOyR4', 'get_ServiceLocator_JdCOyR4Service', true],
            'App\\Controller\\PublicacionController::listarPublicacion' => ['privates', '.service_locator.c_4Rcr2', 'get_ServiceLocator_C4Rcr2Service', true],
            'App\\Controller\\PublicacionController::listarPublicacionporPerfil' => ['privates', '.service_locator.c_4Rcr2', 'get_ServiceLocator_C4Rcr2Service', true],
            'App\\Controller\\PublicacionController::listarPublicacionporPerfilActivas' => ['privates', '.service_locator.c_4Rcr2', 'get_ServiceLocator_C4Rcr2Service', true],
            'App\\Controller\\PublicacionController::listarPublicacionporTematica' => ['privates', '.service_locator.c_4Rcr2', 'get_ServiceLocator_C4Rcr2Service', true],
            'App\\Controller\\PublicacionController::listarPublicacionporTipo' => ['privates', '.service_locator.c_4Rcr2', 'get_ServiceLocator_C4Rcr2Service', true],
            'App\\Controller\\RolController::saveRol' => ['privates', '.service_locator.qYeS34A', 'get_ServiceLocator_QYeS34AService', true],
            'App\\Controller\\SeguidorController::dejardeseguir' => ['privates', '.service_locator.nyNxjhi', 'get_ServiceLocator_NyNxjhiService', true],
            'App\\Controller\\SeguidorController::eliminarseguidor' => ['privates', '.service_locator.nyNxjhi', 'get_ServiceLocator_NyNxjhiService', true],
            'App\\Controller\\SeguidorController::listarseguidoresporidperfil' => ['privates', '.service_locator.pmf0SsP', 'get_ServiceLocator_Pmf0SsPService', true],
            'App\\Controller\\SeguidorController::listarseguidosporidusuario' => ['privates', '.service_locator.pmf0SsP', 'get_ServiceLocator_Pmf0SsPService', true],
            'App\\Controller\\UsuarioController::buscaPorId' => ['privates', '.service_locator.nPtAZ4H', 'get_ServiceLocator_NPtAZ4HService', true],
            'App\\Controller\\UsuarioController::buscarPorNombre' => ['privates', '.service_locator.nPtAZ4H', 'get_ServiceLocator_NPtAZ4HService', true],
            'App\\Controller\\UsuarioController::editar' => ['privates', '.service_locator.63NL9lI', 'get_ServiceLocator_63NL9lIService', true],
            'App\\Controller\\UsuarioController::listar' => ['privates', '.service_locator.nPtAZ4H', 'get_ServiceLocator_NPtAZ4HService', true],
            'App\\Controller\\UsuarioController::save' => ['privates', '.service_locator.63NL9lI', 'get_ServiceLocator_63NL9lIService', true],
            'App\\Kernel::loadRoutes' => ['privates', '.service_locator.y4_Zrx.', 'get_ServiceLocator_Y4Zrx_Service', true],
            'App\\Kernel::registerContainerConfiguration' => ['privates', '.service_locator.y4_Zrx.', 'get_ServiceLocator_Y4Zrx_Service', true],
            'kernel::loadRoutes' => ['privates', '.service_locator.y4_Zrx.', 'get_ServiceLocator_Y4Zrx_Service', true],
            'kernel::registerContainerConfiguration' => ['privates', '.service_locator.y4_Zrx.', 'get_ServiceLocator_Y4Zrx_Service', true],
            'App\\Controller\\ComentarioController:listar' => ['privates', '.service_locator.kz6ZuBB', 'get_ServiceLocator_Kz6ZuBBService', true],
            'App\\Controller\\LikeController:cantidadlikesdeComentario' => ['privates', '.service_locator.q1Amhe4', 'get_ServiceLocator_Q1Amhe4Service', true],
            'App\\Controller\\LikeController:cantidadlikesdePublicacion' => ['privates', '.service_locator.q1Amhe4', 'get_ServiceLocator_Q1Amhe4Service', true],
            'App\\Controller\\LikeController:eliminarlikepublicacion' => ['privates', '.service_locator.tncbWWT', 'get_ServiceLocator_TncbWWTService', true],
            'App\\Controller\\LikeController:guardarLikeComentario' => ['privates', '.service_locator.txLU3I6', 'get_ServiceLocator_TxLU3I6Service', true],
            'App\\Controller\\LikeController:guardarLikePublicacion' => ['privates', '.service_locator.VQrjO0l', 'get_ServiceLocator_VQrjO0lService', true],
            'App\\Controller\\LikeController:listarlikesdeComentario' => ['privates', '.service_locator.ICgUdJx', 'get_ServiceLocator_ICgUdJxService', true],
            'App\\Controller\\LikeController:listarlikesdePublicacion' => ['privates', '.service_locator.ICgUdJx', 'get_ServiceLocator_ICgUdJxService', true],
            'App\\Controller\\LoginController:login' => ['privates', '.service_locator.CGq8rmw', 'get_ServiceLocator_CGq8rmwService', true],
            'App\\Controller\\PerfilController:editar' => ['privates', '.service_locator.kqFTv_Y', 'get_ServiceLocator_KqFTvYService', true],
            'App\\Controller\\PerfilController:eliminar' => ['privates', '.service_locator.kqFTv_Y', 'get_ServiceLocator_KqFTvYService', true],
            'App\\Controller\\PerfilController:listar' => ['privates', '.service_locator.5NPK3Ls', 'get_ServiceLocator_5NPK3LsService', true],
            'App\\Controller\\PerfilController:listarPorNombre' => ['privates', '.service_locator.5NPK3Ls', 'get_ServiceLocator_5NPK3LsService', true],
            'App\\Controller\\PerfilController:listarPorUsuario' => ['privates', '.service_locator.5NPK3Ls', 'get_ServiceLocator_5NPK3LsService', true],
            'App\\Controller\\PerfilController:save' => ['privates', '.service_locator.JcVzCu4', 'get_ServiceLocator_JcVzCu4Service', true],
            'App\\Controller\\PublicacionController:editarPublicacion' => ['privates', '.service_locator.jdCOyR4', 'get_ServiceLocator_JdCOyR4Service', true],
            'App\\Controller\\PublicacionController:eliminarPublicacion' => ['privates', '.service_locator.6rnaC2K', 'get_ServiceLocator_6rnaC2KService', true],
            'App\\Controller\\PublicacionController:guardarPublicacion' => ['privates', '.service_locator.jdCOyR4', 'get_ServiceLocator_JdCOyR4Service', true],
            'App\\Controller\\PublicacionController:listarPublicacion' => ['privates', '.service_locator.c_4Rcr2', 'get_ServiceLocator_C4Rcr2Service', true],
            'App\\Controller\\PublicacionController:listarPublicacionporPerfil' => ['privates', '.service_locator.c_4Rcr2', 'get_ServiceLocator_C4Rcr2Service', true],
            'App\\Controller\\PublicacionController:listarPublicacionporPerfilActivas' => ['privates', '.service_locator.c_4Rcr2', 'get_ServiceLocator_C4Rcr2Service', true],
            'App\\Controller\\PublicacionController:listarPublicacionporTematica' => ['privates', '.service_locator.c_4Rcr2', 'get_ServiceLocator_C4Rcr2Service', true],
            'App\\Controller\\PublicacionController:listarPublicacionporTipo' => ['privates', '.service_locator.c_4Rcr2', 'get_ServiceLocator_C4Rcr2Service', true],
            'App\\Controller\\RolController:saveRol' => ['privates', '.service_locator.qYeS34A', 'get_ServiceLocator_QYeS34AService', true],
            'App\\Controller\\SeguidorController:dejardeseguir' => ['privates', '.service_locator.nyNxjhi', 'get_ServiceLocator_NyNxjhiService', true],
            'App\\Controller\\SeguidorController:eliminarseguidor' => ['privates', '.service_locator.nyNxjhi', 'get_ServiceLocator_NyNxjhiService', true],
            'App\\Controller\\SeguidorController:listarseguidoresporidperfil' => ['privates', '.service_locator.pmf0SsP', 'get_ServiceLocator_Pmf0SsPService', true],
            'App\\Controller\\SeguidorController:listarseguidosporidusuario' => ['privates', '.service_locator.pmf0SsP', 'get_ServiceLocator_Pmf0SsPService', true],
            'App\\Controller\\UsuarioController:buscaPorId' => ['privates', '.service_locator.nPtAZ4H', 'get_ServiceLocator_NPtAZ4HService', true],
            'App\\Controller\\UsuarioController:buscarPorNombre' => ['privates', '.service_locator.nPtAZ4H', 'get_ServiceLocator_NPtAZ4HService', true],
            'App\\Controller\\UsuarioController:editar' => ['privates', '.service_locator.63NL9lI', 'get_ServiceLocator_63NL9lIService', true],
            'App\\Controller\\UsuarioController:listar' => ['privates', '.service_locator.nPtAZ4H', 'get_ServiceLocator_NPtAZ4HService', true],
            'App\\Controller\\UsuarioController:save' => ['privates', '.service_locator.63NL9lI', 'get_ServiceLocator_63NL9lIService', true],
            'kernel:loadRoutes' => ['privates', '.service_locator.y4_Zrx.', 'get_ServiceLocator_Y4Zrx_Service', true],
            'kernel:registerContainerConfiguration' => ['privates', '.service_locator.y4_Zrx.', 'get_ServiceLocator_Y4Zrx_Service', true],
        ], [
            'App\\Controller\\ComentarioController::listar' => '?',
            'App\\Controller\\LikeController::cantidadlikesdeComentario' => '?',
            'App\\Controller\\LikeController::cantidadlikesdePublicacion' => '?',
            'App\\Controller\\LikeController::eliminarlikepublicacion' => '?',
            'App\\Controller\\LikeController::guardarLikeComentario' => '?',
            'App\\Controller\\LikeController::guardarLikePublicacion' => '?',
            'App\\Controller\\LikeController::listarlikesdeComentario' => '?',
            'App\\Controller\\LikeController::listarlikesdePublicacion' => '?',
            'App\\Controller\\LoginController::login' => '?',
            'App\\Controller\\PerfilController::editar' => '?',
            'App\\Controller\\PerfilController::eliminar' => '?',
            'App\\Controller\\PerfilController::listar' => '?',
            'App\\Controller\\PerfilController::listarPorNombre' => '?',
            'App\\Controller\\PerfilController::listarPorUsuario' => '?',
            'App\\Controller\\PerfilController::save' => '?',
            'App\\Controller\\PublicacionController::editarPublicacion' => '?',
            'App\\Controller\\PublicacionController::eliminarPublicacion' => '?',
            'App\\Controller\\PublicacionController::guardarPublicacion' => '?',
            'App\\Controller\\PublicacionController::listarPublicacion' => '?',
            'App\\Controller\\PublicacionController::listarPublicacionporPerfil' => '?',
            'App\\Controller\\PublicacionController::listarPublicacionporPerfilActivas' => '?',
            'App\\Controller\\PublicacionController::listarPublicacionporTematica' => '?',
            'App\\Controller\\PublicacionController::listarPublicacionporTipo' => '?',
            'App\\Controller\\RolController::saveRol' => '?',
            'App\\Controller\\SeguidorController::dejardeseguir' => '?',
            'App\\Controller\\SeguidorController::eliminarseguidor' => '?',
            'App\\Controller\\SeguidorController::listarseguidoresporidperfil' => '?',
            'App\\Controller\\SeguidorController::listarseguidosporidusuario' => '?',
            'App\\Controller\\UsuarioController::buscaPorId' => '?',
            'App\\Controller\\UsuarioController::buscarPorNombre' => '?',
            'App\\Controller\\UsuarioController::editar' => '?',
            'App\\Controller\\UsuarioController::listar' => '?',
            'App\\Controller\\UsuarioController::save' => '?',
            'App\\Kernel::loadRoutes' => '?',
            'App\\Kernel::registerContainerConfiguration' => '?',
            'kernel::loadRoutes' => '?',
            'kernel::registerContainerConfiguration' => '?',
            'App\\Controller\\ComentarioController:listar' => '?',
            'App\\Controller\\LikeController:cantidadlikesdeComentario' => '?',
            'App\\Controller\\LikeController:cantidadlikesdePublicacion' => '?',
            'App\\Controller\\LikeController:eliminarlikepublicacion' => '?',
            'App\\Controller\\LikeController:guardarLikeComentario' => '?',
            'App\\Controller\\LikeController:guardarLikePublicacion' => '?',
            'App\\Controller\\LikeController:listarlikesdeComentario' => '?',
            'App\\Controller\\LikeController:listarlikesdePublicacion' => '?',
            'App\\Controller\\LoginController:login' => '?',
            'App\\Controller\\PerfilController:editar' => '?',
            'App\\Controller\\PerfilController:eliminar' => '?',
            'App\\Controller\\PerfilController:listar' => '?',
            'App\\Controller\\PerfilController:listarPorNombre' => '?',
            'App\\Controller\\PerfilController:listarPorUsuario' => '?',
            'App\\Controller\\PerfilController:save' => '?',
            'App\\Controller\\PublicacionController:editarPublicacion' => '?',
            'App\\Controller\\PublicacionController:eliminarPublicacion' => '?',
            'App\\Controller\\PublicacionController:guardarPublicacion' => '?',
            'App\\Controller\\PublicacionController:listarPublicacion' => '?',
            'App\\Controller\\PublicacionController:listarPublicacionporPerfil' => '?',
            'App\\Controller\\PublicacionController:listarPublicacionporPerfilActivas' => '?',
            'App\\Controller\\PublicacionController:listarPublicacionporTematica' => '?',
            'App\\Controller\\PublicacionController:listarPublicacionporTipo' => '?',
            'App\\Controller\\RolController:saveRol' => '?',
            'App\\Controller\\SeguidorController:dejardeseguir' => '?',
            'App\\Controller\\SeguidorController:eliminarseguidor' => '?',
            'App\\Controller\\SeguidorController:listarseguidoresporidperfil' => '?',
            'App\\Controller\\SeguidorController:listarseguidosporidusuario' => '?',
            'App\\Controller\\UsuarioController:buscaPorId' => '?',
            'App\\Controller\\UsuarioController:buscarPorNombre' => '?',
            'App\\Controller\\UsuarioController:editar' => '?',
            'App\\Controller\\UsuarioController:listar' => '?',
            'App\\Controller\\UsuarioController:save' => '?',
            'kernel:loadRoutes' => '?',
            'kernel:registerContainerConfiguration' => '?',
        ]);
    }
}
