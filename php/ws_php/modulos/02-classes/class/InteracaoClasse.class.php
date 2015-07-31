<?php

/**
 * ModelagemDeClasse.class.php [ TIPO ]
 * Descricao
 * @copyright (c) year, Filipe Leuch Bonfim UPINSIDE
 */
class InteracaoClasse {

    public $nome;
    public $idade;
    public $profissao;
    public $conta;
    public $salario;
    public $empresa;
    
    function __construct($nome, $idade, $profissao, $conta) {
        $this->nome = $nome;
        $this->idade = $idade;
        $this->profissao = $profissao;
        $this->conta= $conta;
    }
    
    public function trabalhar($empresa, $salario, $profissao) {
        $this->empresa = $empresa;
        $this->salario = $salario;
        $this->profissao = $profissao;
    }
    
    public function receber($valor) {
        $this->conta += $valor;
    }

}
