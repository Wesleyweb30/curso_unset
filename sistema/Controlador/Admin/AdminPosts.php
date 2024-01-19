<?php 
namespace sistema\Controlador\Admin;

use sistema\Modelo\CategoriaModelo;
use sistema\Modelo\PostModelo;
use sistema\Nucleo\Helpers;
use Twig\Node\Expression\Filter\DefaultFilter;

    class AdminPosts extends AdminControlador
    {
        public function all():void{
            echo $this->template->renderizar('posts/listar.html',
            [
                'posts' => (new PostModelo())->all(),
                'total' => (new PostModelo())->total(),
            ]);
        }

        public function insert():void
        {
            $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            if(isset($dados))
            {
                (new PostModelo())->insert($dados);
                Helpers::redirecionamento('admin/posts/listar');
            }

            echo $this->template->renderizar('posts/formulario.html',
            [
                'categorias' => (new CategoriaModelo())->all()
            ]);
        }

        public function update(int $id):void
        {
            $post = (new PostModelo())->post($id);
            
            $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            if(isset($dados))
            {
                (new PostModelo())->update($dados, $id);
                Helpers::redirecionamento('admin/posts/listar');
            }


            echo $this->template->renderizar('posts/formulario.html',
            [
                'post' => $post,
                'categorias' => (new CategoriaModelo())->all()
            ]);
        }

        public function delete(int $id): void
        {
            (new PostModelo())->delete($id);
            Helpers::redirecionamento('admin/posts/listar');
        }
    }

?>