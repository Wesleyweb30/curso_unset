<?php 

    namespace sistema\Nucleo;

    class Mensagem
    {
       private $texto;
       private $css;

    public function __toString()
    {
        return $this->renderizar();   
    }

    public function sucesso(string $mensagem) : Mensagem
    {
        $this->css = 'alert alert-success';
        $this->texto = $this->filtar($mensagem);
        return $this;
    }
    public function erro(string $mensagem) : Mensagem
    {   
        $this->css = 'alert alert-danger';
        $this->texto = $this->filtar($mensagem);
        return $this;
    }  

    public function renderizar() : string
    {
        return "<div class = '{$this->css}'> {$this->texto} </div>";
    }
    
    private function filtar(string $mensagem): string
    {
        return filter_var($mensagem, FILTER_SANITIZE_SPECIAL_CHARS);
    }

    }
?>