<?php 
namespace sistema\Controlador\Admin;

use sistema\Modelo\PostModelo;

class AdminRotas extends AdminControlador
{

    public function painel():void{
        echo $this->template->renderizar('dashboard.html',
        [
            'posts' => (new PostModelo())->all(),
        ]);
    }
    
}

?>