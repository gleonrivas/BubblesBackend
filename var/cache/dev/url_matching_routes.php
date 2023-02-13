<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/access/token' => [[['_route' => 'app_access_token', '_controller' => 'App\\Controller\\AccessTokenController::index'], null, null, null, false, false, null]],
        '/comentario' => [[['_route' => 'app_comentario', '_controller' => 'App\\Controller\\ComentarioController::index'], null, null, null, false, false, null]],
        '/api/comentario/listar' => [[['_route' => 'app_comentario_listar', '_controller' => 'App\\Controller\\ComentarioController::listar'], null, ['GET' => 0], null, false, false, null]],
        '/like' => [[['_route' => 'app_like', '_controller' => 'App\\Controller\\LikeController::index'], null, null, null, false, false, null]],
        '/api/login' => [[['_route' => 'app_login', '_controller' => 'App\\Controller\\LoginController::login'], null, ['POST' => 0], null, false, false, null]],
        '/mensaje' => [[['_route' => 'app_mensaje', '_controller' => 'App\\Controller\\MensajeController::index'], null, null, null, false, false, null]],
        '/perfil' => [[['_route' => 'app_perfil', '_controller' => 'App\\Controller\\PerfilController::index'], null, null, null, false, false, null]],
        '/api/perfil/listar' => [[['_route' => 'app_perfil_listar', '_controller' => 'App\\Controller\\PerfilController::listar'], null, ['GET' => 0], null, false, false, null]],
        '/permiso' => [[['_route' => 'app_permiso', '_controller' => 'App\\Controller\\PermisoController::index'], null, null, null, false, false, null]],
        '/publicacion' => [[['_route' => 'app_publicacion', '_controller' => 'App\\Controller\\PublicacionController::index'], null, null, null, false, false, null]],
        '/api/publicacion/listar' => [[['_route' => 'app_publicacaion', '_controller' => 'App\\Controller\\PublicacionController::listarPublicacion'], null, ['GET' => 0], null, false, false, null]],
        '/api/publicacion/guardar' => [[['_route' => 'app_publicacaion_crear', '_controller' => 'App\\Controller\\PublicacionController::guardarPublicacion'], null, ['POST' => 0], null, false, false, null]],
        '/api/publicacion/editar' => [[['_route' => 'app_publicacaion_editar', '_controller' => 'App\\Controller\\PublicacionController::editarPublicacion'], null, ['POST' => 0], null, false, false, null]],
        '/rol' => [[['_route' => 'app_rol', '_controller' => 'App\\Controller\\RolController::index'], null, null, null, false, false, null]],
        '/rol/guardar' => [[['_route' => 'app_rol_guardar', '_controller' => 'App\\Controller\\RolController::saveRol'], null, ['POST' => 0], null, false, false, null]],
        '/usuario' => [[['_route' => 'app_usuario', '_controller' => 'App\\Controller\\UsuarioController::index'], null, ['GET' => 0], null, false, false, null]],
        '/api/usuario/listar' => [[['_route' => 'app_usuario_listar', '_controller' => 'App\\Controller\\UsuarioController::listar'], null, ['GET' => 0], null, false, false, null]],
        '/api/usuario/guardar' => [[['_route' => 'app_usuario_crear', '_controller' => 'App\\Controller\\UsuarioController::save'], null, ['POST' => 0], null, false, false, null]],
        '/api/doc' => [[['_route' => 'app.swagger_ui', '_controller' => 'nelmio_api_doc.controller.swagger_ui'], null, ['GET' => 0], null, false, false, null]],
        '/api/doc.json' => [[['_route' => 'app.swagger', '_controller' => 'nelmio_api_doc.controlaaler.swagger'], null, ['GET' => 0], null, false, false, null]],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/_error/(\\d+)(?:\\.([^/]++))?(*:35)'
                .'|/api/(?'
                    .'|comentario/listar/([^/]++)(*:76)'
                    .'|like(?'
                        .'|/(?'
                            .'|listar/(?'
                                .'|publicacion/([^/]++)(*:124)'
                                .'|comentario/([^/]++)(*:151)'
                            .')'
                            .'|cantidad/(?'
                                .'|publicacion/([^/]++)(*:192)'
                                .'|comentario/([^/]++)(*:219)'
                            .')'
                            .'|eliminar/([^/]++)(*:245)'
                        .')'
                        .'|publicacion/guardar/([^/]++)/([^/]++)(*:291)'
                        .'|comentario/guardar/([^/]++)/([^/]++)(*:335)'
                        .'|Publicacion/listar/([^/]++)(*:370)'
                    .')'
                    .'|p(?'
                        .'|erfil/(?'
                            .'|([^/]++)(*:400)'
                            .'|listar(?'
                                .'|/([^/]++)(*:426)'
                                .'|PorUsuario(*:444)'
                            .')'
                            .'|guardar(*:460)'
                            .'|e(?'
                                .'|ditar(*:477)'
                                .'|liminar/([^/]++)(*:501)'
                            .')'
                        .')'
                        .'|ublicacion/(?'
                            .'|listar/(?'
                                .'|([^/]++)(*:543)'
                                .'|activas/([^/]++)(*:567)'
                                .'|t(?'
                                    .'|ematica/([^/]++)(*:595)'
                                    .'|ipo/([^/]++)(*:615)'
                                .')'
                            .')'
                            .'|eliminar/([^/]++)(*:642)'
                        .')'
                    .')'
                    .'|seguido(?'
                        .'|r(?'
                            .'|/(?'
                                .'|crear/([^/]++)/([^/]++)(*:693)'
                                .'|eliminar/([^/]++)/([^/]++)(*:727)'
                            .')'
                            .'|es/listar/([^/]++)(*:754)'
                        .')'
                        .'|s/listar/([^/]++)(*:780)'
                        .'|/eliminar/([^/]++)/([^/]++)(*:815)'
                    .')'
                    .'|usuario/listar(?'
                        .'|PorNombre/([^/]++)(*:859)'
                        .'|/([^/]++)(*:876)'
                    .')'
                .')'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        35 => [[['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
        76 => [[['_route' => 'app_comentario_listar_id', '_controller' => 'App\\Controller\\ComentarioController::listarPorIdUsuario'], ['id'], ['GET' => 0], null, false, true, null]],
        124 => [[['_route' => 'app_like_publicacion', '_controller' => 'App\\Controller\\LikeController::listarlikesdePublicacion'], ['id_publicacion'], ['GET' => 0], null, false, true, null]],
        151 => [[['_route' => 'app_like_comentario', '_controller' => 'App\\Controller\\LikeController::listarlikesdeComentario'], ['id_comentario'], ['GET' => 0], null, false, true, null]],
        192 => [[['_route' => 'app_like_cantidad_publicacion', '_controller' => 'App\\Controller\\LikeController::cantidadlikesdePublicacion'], ['id_publicacion'], ['GET' => 0], null, false, true, null]],
        219 => [[['_route' => 'app_like_cantidad_comentario', '_controller' => 'App\\Controller\\LikeController::cantidadlikesdeComentario'], ['id_comentario'], ['GET' => 0], null, false, true, null]],
        245 => [[['_route' => 'app_like_eliminar', '_controller' => 'App\\Controller\\LikeController::eliminarlikepublicacion'], ['id'], ['DELETE' => 0], null, false, true, null]],
        291 => [[['_route' => 'app_likepublicacaion_crear', '_controller' => 'App\\Controller\\LikeController::guardarLikePublicacion'], ['id_publicacion', 'id_perfil'], ['POST' => 0], null, false, true, null]],
        335 => [[['_route' => 'app_likecomentario_crear', '_controller' => 'App\\Controller\\LikeController::guardarLikeComentario'], ['id_comentario', 'id_perfil'], ['POST' => 0], null, false, true, null]],
        370 => [[['_route' => 'app_likePublicacion_listar', '_controller' => 'App\\Controller\\LikeController::listarPublicacion'], ['id_perfil'], ['GET' => 0], null, false, true, null]],
        400 => [[['_route' => 'app_perfil_id', '_controller' => 'App\\Controller\\PerfilController::perfilPorId'], ['id'], ['GET' => 0], null, false, true, null]],
        426 => [[['_route' => 'app_perfil_listarPorNombre', '_controller' => 'App\\Controller\\PerfilController::listarPorNombre'], ['username'], ['GET' => 0], null, false, true, null]],
        444 => [[['_route' => 'app_perfil_listarPorUsuario', '_controller' => 'App\\Controller\\PerfilController::listarPorUsuario'], [], ['GET' => 0], null, true, false, null]],
        460 => [[['_route' => 'app_perfil_guardar', '_controller' => 'App\\Controller\\PerfilController::save'], [], ['POST' => 0], null, false, false, null]],
        477 => [[['_route' => 'app_perfil_editar', '_controller' => 'App\\Controller\\PerfilController::editar'], [], ['POST' => 0], null, false, false, null]],
        501 => [[['_route' => 'app_perfil_eliminar', '_controller' => 'App\\Controller\\PerfilController::eliminar'], ['id'], ['DELETE' => 0], null, false, true, null]],
        543 => [[['_route' => 'app_publicacaion_listar_usuario', '_controller' => 'App\\Controller\\PublicacionController::listarPublicacionporPerfil'], ['id'], ['GET' => 0], null, false, true, null]],
        567 => [[['_route' => 'app_publicacaion_listar_activas', '_controller' => 'App\\Controller\\PublicacionController::listarPublicacionporPerfilActivas'], ['id'], ['GET' => 0], null, false, true, null]],
        595 => [[['_route' => 'app_publicacaion_listar_tematica', '_controller' => 'App\\Controller\\PublicacionController::listarPublicacionporTematica'], ['tematica'], ['GET' => 0], null, false, true, null]],
        615 => [[['_route' => 'app_publicacaion_listar_tipo', '_controller' => 'App\\Controller\\PublicacionController::listarPublicacionporTipo'], ['tipo'], ['GET' => 0], null, false, true, null]],
        642 => [[['_route' => 'app_publicacaion_eliminar', '_controller' => 'App\\Controller\\PublicacionController::eliminarPublicacion'], ['id'], ['DELETE' => 0], null, false, true, null]],
        693 => [[['_route' => 'app_seguidor_crear', '_controller' => 'App\\Controller\\SeguidorController::guardarSeguidor'], ['id_principal', 'id_follower'], ['POST' => 0], null, false, true, null]],
        727 => [[['_route' => 'app_eliminar_seguidor', '_controller' => 'App\\Controller\\SeguidorController::eliminarseguidor'], ['id', 'id_seguidor'], ['DELETE' => 0], null, false, true, null]],
        754 => [[['_route' => 'app_seguidor', '_controller' => 'App\\Controller\\SeguidorController::listarseguidoresporidperfil'], ['id'], ['GET' => 0], null, false, true, null]],
        780 => [[['_route' => 'app_seguidores', '_controller' => 'App\\Controller\\SeguidorController::listarseguidosporidusuario'], ['id'], ['GET' => 0], null, false, true, null]],
        815 => [[['_route' => 'app_dejar_seguir', '_controller' => 'App\\Controller\\SeguidorController::dejardeseguir'], ['id', 'id_seguido'], ['DELETE' => 0], null, false, true, null]],
        859 => [[['_route' => 'app_usuario_buscar_id', '_controller' => 'App\\Controller\\UsuarioController::buscaPorId'], ['id'], ['GET' => 0], null, false, true, null]],
        876 => [
            [['_route' => 'app_usuario_buscar_nombre', '_controller' => 'App\\Controller\\UsuarioController::buscarPorNombre'], ['nombre'], ['GET' => 0], null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
