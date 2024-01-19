<?php 
    use Pecee\SimpleRouter\SimpleRouter;
    use sistema\Nucleo\Helpers;

    try {
        /**Rotas do admin */
        SimpleRouter::group(['namespace' => 'Admin'], function()
        {
            SimpleRouter::get(URL_ADMIN. "painel", 'AdminRotas@painel');

            /**Posts */
            SimpleRouter::get(URL_ADMIN. "posts/listar", 'AdminPosts@all');
            SimpleRouter::match(['get', 'post'], URL_ADMIN. 'posts/cadastrar', "AdminPosts@insert");
            SimpleRouter::match(['get', 'post'], URL_ADMIN. 'posts/editar/{id}', "AdminPosts@update");
            SimpleRouter::get(URL_ADMIN. 'posts/deletar/{id}', "AdminPosts@delete");

            /**Categoria */
            SimpleRouter::get(URL_ADMIN. "categorias/listar", 'AdminCategorias@all');
            SimpleRouter::match(['get', 'post'], URL_ADMIN. 'categorias/cadastrar', "AdminCategorias@insert");  
            SimpleRouter::match(['get', 'post'], URL_ADMIN. 'categorias/editar/{id}', "AdminCategorias@update");  
            SimpleRouter::get(URL_ADMIN. 'categorias/deletar/{id}', "AdminCategorias@delete");  
        });

        /**Rotas public */
        SimpleRouter::setDefaultNamespace("sistema\Controlador");
        SimpleRouter::get(URL_SITE, "SiteControlador@index");
        SimpleRouter::get(URL_SITE. "sobre", "SiteControlador@sobre");
        SimpleRouter::get(URL_SITE. "post/{id}", "SiteControlador@post");
        SimpleRouter::get(URL_SITE. "categoria{id}", "SiteControlador@categoria");
        SimpleRouter::post(URL_SITE."buscar", "SiteControlador@buscar");
        
        /**Rotas não encontrada! */
        SimpleRouter::get(URL_SITE . "404", "SiteControlador@erro");

        SimpleRouter::start();
        
    } catch(Pecee\SimpleRouter\Exceptions\NotFoundHttpException $ex) 
    {
        if (Helpers::localhost())
        {
            echo $ex;
        }
        else 
        Helpers::redirecionamento('404');
    }
   
        
    
    
     







?>