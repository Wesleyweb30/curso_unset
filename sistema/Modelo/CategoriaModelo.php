<?php 
namespace sistema\Modelo;
use sistema\Nucleo\Conexao;

    class CategoriaModelo extends Conexao
    {
        
        function all(): array
        {
            $query = "SELECT * FROM categorias ORDER BY id ASC ";
            $stmt = Conexao::getInstancia()->query($query);
            $resultado = $stmt->fetchAll();
            return $resultado;
        }
        
        function categoria(int $id) : bool|object
        {
            $query = "SELECT * FROM categorias WHERE id={$id}";
            $stmt = Conexao::getInstancia()->query($query);
            $resultado = $stmt->fetch();
            return $resultado;
        }

        function insert(array $dados): void
        {
            $query = "INSERT INTO categorias (titulo) VALUE (?)";
            $stmt = Conexao::getInstancia()->prepare($query);
            $stmt->execute([$dados['titulo']]);
        }

        function update(array $dados, int $id): void
        {
            $query = "UPDATE categorias SET titulo = :titulo WHERE id={$id}";
            $stmt = Conexao::getInstancia()->prepare($query);
            $stmt->execute($dados);
        }
        
        function posts($id): array
        {
            $query = "SELECT * FROM posts WHERE categoria_id = {$id}";
            $stmt = Conexao::getInstancia()->query($query);
            $resultado = $stmt->fetchAll();
            return $resultado;
        }

        function delete(int $id) : void
        {
            $query = "DELETE FROM categorias WHERE id ={$id}";
            $stmt = Conexao::getInstancia()->prepare($query);
            $stmt->execute();
            
        }      



       

        
        

        

    }

?>