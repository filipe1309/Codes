<?php

/**
 * ComportamentoInicial.class.php [ TIPO ]
 * Descricao
 * @copyright (c) year, Filipe Leuch Bonfim UPINSIDE
 */
class ComportamentoInicial {

    var $nome, $idade, $profissao, $salario;
    
    function __construct($nome, $idade, $profissao, $salario) {
        $this->nome = (string) $nome;
        $this->idade = (int) $idade;
        $this->profissao = (string) $profissao;
        $this->salario = (float) $salario;
        echo "O objeto {$this->nome} foi iniciado!<hr>";
    }
    
    function __destruct() {
        echo "O objeto {$this->nome} foi destruido!<hr>";
    }
            
    function ver() {
        echo '<pre>';
        print_r($this);
        echo '</pre>';
    }
}
