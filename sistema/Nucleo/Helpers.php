<?php
    namespace sistema\Nucleo;
    use Exception;
    class Helpers
    {

        static function resumirTexto(string $texto, int $limite, string $continue = '...') :string
        {
            $textolimpo = trim($texto);
            if(mb_strlen($textolimpo) <= $limite){
            return $textolimpo;
            }
            $resumirTexto = mb_substr($textolimpo, 0, mb_strrpos(mb_substr($textolimpo, 0, $limite),  ''));

            return $resumirTexto.$continue;
        }   


        public static function redirecionamento(string $url = null ): void{
             header("'HTTP/1.1 302 Found ");
             $local = ($url ? self::url($url) : self::url());
             header("Location: {$local} ");
             exit();
        }
        
        public static function validarCpf(string $cpf) : bool {
            $cpf = self::limparNumero($cpf);

            if (mb_strlen($cpf) != 11 or preg_match('/(d)\1{10}/', $cpf)){
                throw new Exception('O cpf precisar ter 11 digitos!!');
            }
            for ($t = 9; $t < 11; $t++) {
                for ($d = 0, $c = 0; $c < $t; $c++) {
                    $d += $cpf[$c] * (($t + 1) - $c);
                }
                $d = ((10 * $d) % 11) % 10;
                if ($cpf[$c] != $d) {
                    throw new Exception('Cpf invalido!!');
                }    
            }
            return true;
        }

        public static function limparNumero(string $numero){
            return preg_replace('/[^0-9]/','', $numero);
        }

        public static function url(string $url = null) : string
        {
            $servidor = filter_input(INPUT_SERVER, 'SERVER_NAME');
            $ambiente = ($servidor == 'localhost' ?URL_DESENVOLVIMENTO : URL_PRODUCAO);
            if (str_starts_with($url, '/')) {
                return $ambiente . $url;
            }
            return $ambiente .  '/' . $url;
        }
    
        public static function localhost() : bool
        {
            $servidor = filter_input(INPUT_SERVER,'SERVER_NAME');
            if ($servidor == 'localhost') {
                return true;
            }
            return false;
        }
    
       public static function mostraData() : string
       {
            return  date('Y-m-d H:i:s');
       }
       
       
    
       public static function formatarValor(float $valor): string
        {
    
            return number_format($valor, 2, ',', '.');
        }
     
    
    }


?>