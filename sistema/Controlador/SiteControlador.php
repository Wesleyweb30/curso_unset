<?php 
    namespace sistema\Controlador;

    use sistema\Nucleo\Controlador;
    use sistema\Nucleo\Helpers;

    use sistema\Modelo\PostModelo;
    use sistema\Modelo\CategoriaModelo;


    class SiteControlador extends Controlador
    {
        public function __construct()
        {
            parent::__construct('templates/site/views');
        }

        
        public function index(): void
        {
            echo $this->template->renderizar('index.html',[

                'posts'=> (new PostModelo())->ler(),
                'categorias' => (new CategoriaModelo())->ler(),
            
            ]);
        }

        public function sobre(): void
        {
            echo $this->template->renderizar('sobre.html', [
                'titulo' => 'Sobre',
                'texto' => 'Texto sobre o Enem',
            ]);
        }

        public function post(int $id): void
        {

            $post = (new PostModelo())->buscarPorId($id);
            if (!$post) {
                Helpers::redirecionamento('404');
            }
            
             echo $this->template->renderizar('post.html', [
            'post' => $post,
            'categorias' => (new CategoriaModelo())->ler(),   
            ]);
        }

        public function categoria(int $id): void
        {
            echo $this->template->renderizar('categoria.html',
            [
                "posts" => (new CategoriaModelo())->posts($id),
                "categorias" => (new CategoriaModelo())->ler(),  
            ]);
        }
        
        //fazer uma pesquina no site
        public function buscar(): void
        {
            $buscar = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            
            if(isset($buscar))
            {
                $posts = (new PostModelo())->Pesquisa($buscar['buscar']);
                echo $this->template->renderizar('busca.html',
                [
                    "posts" => $posts,
                    "categorias" => (new CategoriaModelo())->ler(),
                
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