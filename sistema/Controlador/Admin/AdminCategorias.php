<?php 
namespace sistema\Controlador\Admin;

use sistema\Nucleo\Helpers;
use sistema\Modelo\CategoriaModelo;

    class AdminCategorias extends AdminControlador
    {
        public function all():void{
            echo $this->template->renderizar('categorias/listar.html',
            [
                'categorias' => (new CategoriaModelo())->all(),
            ]);
        }

        /*Metodo salvar uma nova categoria*/
        public function insert():void{

            $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            if (isset($dados))
            {
                (new CategoriaModelo())->insert($dados);
                Helpers::redirecionamento('admin/categorias/listar');
            }
                
            echo $this->template->renderizar('categorias/formulario.html',
            [
            
            ]);
        }

        public function update(int $id):void
        {
            $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            
            if (isset($dados))
            {
                (new CategoriaModelo())->update($dados, $id);
                Helpers::redirecionamento('admin/categorias/listar');
            }

            $categoria = (new CategoriaModelo())->categoria($id);

            echo $this->template->renderizar('categorias/formulario.html',
            [
              'categoria' => $categoria
            ]);
        }

        public function delete(int $id):void
        {
                (new CategoriaModelo())->delete($id);
                Helpers::redirecionamento('admin/categorias/listar');
        }
        
    }
    
?>