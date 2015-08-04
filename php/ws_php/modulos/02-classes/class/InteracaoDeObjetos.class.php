<?php

/**
 * InteracaoDeObjetos.class.php [ TIPO ]
 * Descricao
 * @copyright (c) year, Filipe Leuch Bonfim UPINSIDE
 */
class InteracaoDeObjetos {

    public $empresa;
    public $setores;
    
    /** @var InteracaoClasse */
    public $funcionario;
    
    function __construct($empresa) {
        $this->empresa = $empresa;
        $this->setores = 0;
    }
    
    public  function contratar($funcionario, $cargo, $salario) {
        $this->funcionario = (object) $funcionario;
        $this->funcionario->trabalhar($this->empresa, $salario, $cargo);
        $this->setores += 1;
    }
    
    public function pagar() {
        $this->funcionario->receber($this->funcionario->salario);
    }
    
    public function promover($cargo, $salario = null) {
        $this->funcionario->profissao = $cargo;
        if($salario) {
            $this->funcionario->salario = $salario;
        }
    }
    
    public function funcionarios($funcionario) {
        $this->funcionario = (object) $funcionario;
    }
    
    public function demitir($recisao) {
        $this->funcionario->receber($recisao);
        $this->funcionario->empresa = null;
        $this->funcionario->salario = null;
        $this->setores -= 1;
    }
}
