<?php

// This file has been auto-generated by the Symfony Routing Component.

return [
    '_preview_error' => [['code', '_format'], ['_controller' => 'error_controller::preview', '_format' => 'html'], ['code' => '\\d+'], [['variable', '.', '[^/]++', '_format', true], ['variable', '/', '\\d+', 'code', true], ['text', '/_error']], [], [], []],
    'app_access_token' => [[], ['_controller' => 'App\\Controller\\AccessTokenController::index'], [], [['text', '/access/token']], [], [], []],
    'app_comentario' => [[], ['_controller' => 'App\\Controller\\ComentarioController::index'], [], [['text', '/comentario']], [], [], []],
    'app_comentario_listar' => [[], ['_controller' => 'App\\Controller\\ComentarioController::listar'], [], [['text', '/api/comentario/listar']], [], [], []],
    'app_comentario_listarPorLikes' => [['id_publicacion'], ['_controller' => 'App\\Controller\\ComentarioController::listarPorLikes'], [], [['variable', '/', '[^/]++', 'id_publicacion', true], ['text', '/api/comentario/listarPorLikes']], [], [], []],
    'app_comentario_guardar' => [[], ['_controller' => 'App\\Controller\\ComentarioController::save'], [], [['text', '/api/comentario/guardar']], [], [], []],
    'app_like' => [[], ['_controller' => 'App\\Controller\\LikeController::index'], [], [['text', '/like']], [], [], []],
    'app_like_publicacion' => [['id_publicacion'], ['_controller' => 'App\\Controller\\LikeController::listarlikesdePublicacion'], [], [['variable', '/', '[^/]++', 'id_publicacion', true], ['text', '/api/like/listar/publicacion']], [], [], []],
    'app_like_cantidad_publicacion' => [['id_publicacion'], ['_controller' => 'App\\Controller\\LikeController::cantidadlikesdePublicacion'], [], [['variable', '/', '[^/]++', 'id_publicacion', true], ['text', '/api/like/cantidad/publicacion']], [], [], []],
    'app_like_comentario' => [['id_comentario'], ['_controller' => 'App\\Controller\\LikeController::listarlikesdeComentario'], [], [['variable', '/', '[^/]++', 'id_comentario', true], ['text', '/api/like/listar/comentario']], [], [], []],
    'app_like_cantidad_comentario' => [['id_comentario'], ['_controller' => 'App\\Controller\\LikeController::cantidadlikesdeComentario'], [], [['variable', '/', '[^/]++', 'id_comentario', true], ['text', '/api/like/cantidad/comentario']], [], [], []],
    'app_like_eliminar' => [['id'], ['_controller' => 'App\\Controller\\LikeController::eliminarlikepublicacion'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/api/like/eliminar']], [], [], []],
    'app_likepublicacaion_crear' => [['id_publicacion', 'id_perfil'], ['_controller' => 'App\\Controller\\LikeController::guardarLikePublicacion'], [], [['variable', '/', '[^/]++', 'id_perfil', true], ['variable', '/', '[^/]++', 'id_publicacion', true], ['text', '/api/likepublicacion/guardar']], [], [], []],
    'app_likecomentario_crear' => [['id_comentario', 'id_perfil'], ['_controller' => 'App\\Controller\\LikeController::guardarLikeComentario'], [], [['variable', '/', '[^/]++', 'id_perfil', true], ['variable', '/', '[^/]++', 'id_comentario', true], ['text', '/api/likecomentario/guardar']], [], [], []],
    'app_likePublicacion_listar' => [['id_perfil'], ['_controller' => 'App\\Controller\\LikeController::listarPublicacion'], [], [['variable', '/', '[^/]++', 'id_perfil', true], ['text', '/api/likePublicacion/listar']], [], [], []],
    'app_login' => [[], ['_controller' => 'App\\Controller\\LoginController::login'], [], [['text', '/api/login']], [], [], []],
    'app_mensaje' => [[], ['_controller' => 'App\\Controller\\MensajeController::index'], [], [['text', '/mensaje']], [], [], []],
    'app_mensaje_listar' => [[], ['_controller' => 'App\\Controller\\MensajeController::listar'], [], [['text', '/api/mensaje/listar']], [], [], []],
    'app_mensaje_listarChat' => [['id_perfil'], ['_controller' => 'App\\Controller\\MensajeController::listarChats'], [], [['variable', '/', '[^/]++', 'id_perfil', true], ['text', '/api/mensaje/listarChats']], [], [], []],
    'app_mensaje_mandarMensaje' => [[], ['_controller' => 'App\\Controller\\MensajeController::mandarMensajes'], [], [['text', '/api/mensaje/mandarMensaje']], [], [], []],
    'app_perfil' => [[], ['_controller' => 'App\\Controller\\PerfilController::index'], [], [['text', '/perfil']], [], [], []],
    'app_perfil_listar' => [[], ['_controller' => 'App\\Controller\\PerfilController::listar'], [], [['text', '/api/perfil/listar']], [], [], []],
    'app_perfil_listarPorNombre' => [['username'], ['_controller' => 'App\\Controller\\PerfilController::listarPorNombre'], [], [['variable', '/', '[^/]++', 'username', true], ['text', '/api/perfil/listar']], [], [], []],
    'app_perfil_listarPorUsuario' => [[], ['_controller' => 'App\\Controller\\PerfilController::listarPorUsuario'], [], [['text', '/api/perfil/listarPorUsuario/']], [], [], []],
    'app_perfil_guardar' => [[], ['_controller' => 'App\\Controller\\PerfilController::save'], [], [['text', '/api/perfil/guardar']], [], [], []],
    'app_perfil_editar' => [[], ['_controller' => 'App\\Controller\\PerfilController::editar'], [], [['text', '/api/perfil/editar']], [], [], []],
    'app_perfil_eliminar' => [['id'], ['_controller' => 'App\\Controller\\PerfilController::eliminar'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/api/perfil/eliminar']], [], [], []],
    'app_permiso' => [[], ['_controller' => 'App\\Controller\\PermisoController::index'], [], [['text', '/permiso']], [], [], []],
    'app_publicacion' => [[], ['_controller' => 'App\\Controller\\PublicacionController::index'], [], [['text', '/publicacion']], [], [], []],
    'app_publicacaion' => [[], ['_controller' => 'App\\Controller\\PublicacionController::listarPublicacion'], [], [['text', '/api/publicacion/listar']], [], [], []],
    'app_publicacaion_listar_usuario' => [['id'], ['_controller' => 'App\\Controller\\PublicacionController::listarPublicacionporPerfil'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/api/publicacion/listar']], [], [], []],
    'app_publicacaion_listar_activas' => [['id'], ['_controller' => 'App\\Controller\\PublicacionController::listarPublicacionporPerfilActivas'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/api/publicacion/listar/activas']], [], [], []],
    'app_publicacaion_listar_tematica' => [['tematica'], ['_controller' => 'App\\Controller\\PublicacionController::listarPublicacionporTematica'], [], [['variable', '/', '[^/]++', 'tematica', true], ['text', '/api/publicacion/listar/tematica']], [], [], []],
    'app_publicacaion_listar_tipo' => [['tipo'], ['_controller' => 'App\\Controller\\PublicacionController::listarPublicacionporTipo'], [], [['variable', '/', '[^/]++', 'tipo', true], ['text', '/api/publicacion/listar/tipo']], [], [], []],
    'app_publicacaion_crear' => [[], ['_controller' => 'App\\Controller\\PublicacionController::guardarPublicacion'], [], [['text', '/api/publicacion/guardar']], [], [], []],
    'app_publicacaion_eliminar' => [['id'], ['_controller' => 'App\\Controller\\PublicacionController::eliminarPublicacion'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/api/publicacion/eliminar']], [], [], []],
    'app_publicacaion_editar' => [[], ['_controller' => 'App\\Controller\\PublicacionController::editarPublicacion'], [], [['text', '/api/publicacion/editar']], [], [], []],
    'app_rol' => [[], ['_controller' => 'App\\Controller\\RolController::index'], [], [['text', '/rol']], [], [], []],
    'app_rol_guardar' => [[], ['_controller' => 'App\\Controller\\RolController::saveRol'], [], [['text', '/rol/guardar']], [], [], []],
    'app_seguidor' => [['id'], ['_controller' => 'App\\Controller\\SeguidorController::listarseguidoresporidperfil'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/api/seguidores/listar']], [], [], []],
    'app_seguidores' => [['id'], ['_controller' => 'App\\Controller\\SeguidorController::listarseguidosporidusuario'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/api/seguidos/listar']], [], [], []],
    'app_eliminar_seguidor' => [['id', 'id_seguidor'], ['_controller' => 'App\\Controller\\SeguidorController::eliminarseguidor'], [], [['variable', '/', '[^/]++', 'id_seguidor', true], ['variable', '/', '[^/]++', 'id', true], ['text', '/api/seguidor/eliminar']], [], [], []],
    'app_dejar_seguir' => [['id', 'id_seguido'], ['_controller' => 'App\\Controller\\SeguidorController::dejardeseguir'], [], [['variable', '/', '[^/]++', 'id_seguido', true], ['variable', '/', '[^/]++', 'id', true], ['text', '/api/seguido/eliminar']], [], [], []],
    'app_usuario' => [[], ['_controller' => 'App\\Controller\\UsuarioController::index'], [], [['text', '/usuario']], [], [], []],
    'app_usuario_listar' => [[], ['_controller' => 'App\\Controller\\UsuarioController::listar'], [], [['text', '/api/usuario/listar']], [], [], []],
    'app_usuario_buscar_id' => [['id'], ['_controller' => 'App\\Controller\\UsuarioController::buscaPorId'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/api/usuario/listar']], [], [], []],
    'app_usuario_buscar_nombre' => [['nombre'], ['_controller' => 'App\\Controller\\UsuarioController::buscarPorNombre'], [], [['variable', '/', '[^/]++', 'nombre', true], ['text', '/api/usuario/listar']], [], [], []],
    'app_usuario_crear' => [[], ['_controller' => 'App\\Controller\\UsuarioController::save'], [], [['text', '/api/usuario/guardar']], [], [], []],
    'app_usuario_editar' => [[], ['_controller' => 'App\\Controller\\UsuarioController::editar'], [], [['text', '/api/usuario/editar']], [], [], []],
    'app.swagger_ui' => [[], ['_controller' => 'nelmio_api_doc.controller.swagger_ui'], [], [['text', '/api/doc']], [], [], []],
    'app.swagger' => [[], ['_controller' => 'nelmio_api_doc.controlaaler.swagger'], [], [['text', '/api/doc.json']], [], [], []],
];
