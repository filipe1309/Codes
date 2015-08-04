<?php

/**
 * HerancaJuridica.class.php [ TIPO ]
 * Descricao
 * @copyright (c) year, Filipe Leuch Bonfim UPINSIDE
 */
class HerancaJuridica extends Heranca {

    public $empresa;
    public $funcionarios;
    
    function __construct($nome, $idade, $empresa) {
        parent::__construct($nome, $idade);
        $this->empresa = $empresa;
    }
    
    public function contratar($pessoa) {
        echo "A empresa {$this->empresa} de {$this->nome} contratou {$pessoa}<hr>";
        $this->funcionarios++;
    }

    public function verEmpresa() {
        echo "{$this->empresa} foi fundada por {$this->nome} e tem {$this->funcionarios} funcionarios <br><small style='color:#09f;'>";
        parent::verPessoa();
        echo "</small>";
    }
    
}
