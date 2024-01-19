<?php 
namespace sistema\Modelo;

use sistema\Nucleo\Conexao;
    class PostModelo 
    {

        public function all(): array 
        {
            $query = "SELECT * FROM posts ORDER BY titulo ASC";
            $stmt = Conexao::getInstancia()->query($query);
            $result = $stmt->fetchAll();
            return $result;
        }

        public function insert(array $dados): void{
            $query = "INSERT INTO `posts` (`id`, `titulo`, `texto`, `categoria_id`, `status`) VALUES (NULL, ?, ?, ?, ?);"; 
            $stmt = Conexao::getInstancia()->prepare($query);
            $stmt->execute([$dados['titulo'], $dados['texto'], $dados['categoria_id'],$dados['status']]);
        }

        function update(array $dados, int $id): void
        {
            $query = "UPDATE posts SET titulo = :titulo, texto = :texto, `categoria_id` = :categoria_id, status = :status WHERE id = {$id}";
            $stmt = Conexao::getInstancia()->prepare($query);
            $stmt->execute($dados);
        }
        

        public function post(int $id): bool|object 
        {
            $query = "SELECT * FROM posts WHERE id = {$id}";
            $stmt = Conexao::getInstancia()->query($query);
            $result = $stmt->fetch();
            return $result;
        }

        public function delete($id):void{
            $query = "DELETE FROM posts WHERE id = {$id}";
            $stmt = Conexao::getInstancia()->query($query);
            $stmt->execute();
        }

        public function BuscarPost(string $buscar): array 
        {
            $query = "SELECT * FROM posts WHERE titulo LIKE '%{$buscar}%'";
            $stmt = Conexao::getInstancia()->query($query);
            $result = $stmt->fetchAll();
            return $result;
        }

        public function total(): int 
        {
            $query = "SELECT * FROM posts";
            $stmt = Conexao::getInstancia()->query($query);
            $result = $stmt->rowCount();
            return $result;
        }
    }


?>