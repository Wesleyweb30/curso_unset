<?php 
namespace sistema\Controlador;

use sistema\Nucleo\Helpers;
/**Twig */
use sistema\Nucleo\Controlador;
/**Model */
use sistema\Modelo\PostModelo;
use sistema\Modelo\CategoriaModelo;


    class SiteControlador extends Controlador
    {
        public function __construct()
        {
            parent::__construct('templates/site/views');
        }


        public function sobre(): void
        {
            echo $this->template->renderizar('sobre.html',
            [
                'titulo' => 'Sobre'
            ]);
        }

        public function index(): void
        {
            echo $this->template->renderizar('index.html',
            [
                'posts'=> (new PostModelo())->all(),
                'categorias' => (new CategoriaModelo())->all(),
            
            ]);
        }

        public function post(int $id): void
        {
            $post = (new PostModelo())->post($id);

            if (!$post)
            {
                Helpers::redirecionamento('404');
            }

            echo $this->template->renderizar('post.html', [
            'post' => $post,
            'categorias' => (new CategoriaModelo())->all(),   
            ]);
        }

       
        public function categoria(int $id): void
        {
            echo $this->template->renderizar('categoria.html',
            [
                "posts" => (new CategoriaModelo())->posts($id),
                "categorias" => (new CategoriaModelo())->all(),  
            ]);
        }
        
        //fazer uma pesquina no site
        public function buscar(): void
        {
            $buscar = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            
            if(isset($buscar))
            {
                $posts = (new PostModelo())->BuscarPost($buscar['buscar']);
                echo $this->template->renderizar('busca.html',
                [
                    "posts" => $posts,
                    "categorias" => (new CategoriaModelo())->all(),
                
                ]);
            }   
        }
   
        public function erro(): void
        {
            echo $this->template->renderizar('erro404.html', [
                'titulo' => 'Pagina não encontrada',
            ]);
        }

        





        

    }
    
?>