<?php 
    
    namespace sistema\Modelo;
    use sistema\Nucleo\Conexao;

    class PostModelo {
        public function ler(): array {
            $query = "SELECT * FROM posts ORDER BY titulo ASC";
            $stmt = Conexao::getInstancia()->query($query);
            $result = $stmt->fetchAll();
            return $result;
        }

        public function buscarPorId(int $id): bool|object {
            $query = "SELECT * FROM posts WHERE id = {$id}";
            $stmt = Conexao::getInstancia()->query($query);
            $result = $stmt->fetch();
            return $result;
        }

        public function Pesquisa(string $buscar): array {
            $query = "SELECT * FROM posts WHERE titulo LIKE '%{$buscar}%'";
            $stmt = Conexao::getInstancia()->query($query);
            $result = $stmt->fetchAll();
            return $result;
        }
    
    
    
    
    
    }


?>