<?php 
namespace sistema\Modelo;
use sistema\Nucleo\Conexao;

class CategoriaModelo extends Conexao{

    function ler(): array
    {
        $query = "SELECT * FROM categorias ORDER BY titulo ASC ";
        $stmt = Conexao::getInstancia()->query($query);
        $resultado = $stmt->fetchAll();
        return $resultado;
    }


    function bucarPorId($id) : bool|object
    {
        $query = "SELECT FROM categorias WHERE id = {$id}";
        $stmt = Conexao::getInstancia()->query($query);
        $resultado = $stmt->fetch();
        return $resultado;
    }


    function posts($id): array
    {
        $query = "SELECT * FROM posts WHERE categoria_id = {$id}";
        $stmt = Conexao::getInstancia()->query($query);
        $resultado = $stmt->fetchAll();
        return $resultado;
    }
}





?>