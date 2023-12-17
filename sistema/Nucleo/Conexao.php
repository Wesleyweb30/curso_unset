<?php 

    namespace sistema\Nucleo;

    use PDO;
    use PDOException;

    class Conexao 
    {
        private static $instancia;

        public static function getInstancia() : PDO
        {
            if (empty(self::$instancia)) {
            
                try 
                {
                    self::$instancia = new PDO('mysql:host='.HOST_NAME.';dbname='.DB_NAME, DB_USER, DB_PASSWORD,
                     [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::FETCH_OBJ => PDO::FETCH_ASSOC,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                        PDO::ATTR_CASE => PDO::CASE_NATURAL,
                        
                    ]);
                } catch (PDOException $e) 
                {

                    die('Erro de conexao: '. $e->getMessage());
                }
            
                  
            } 
            return self::$instancia; 
        }

        #Protegendo a classe Conexao.
     
    }   
