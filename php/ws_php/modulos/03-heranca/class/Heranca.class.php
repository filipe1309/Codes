<?php

/**
 * Heranca.class.php [ TIPO ]
 * Descricao
 * @copyright (c) year, Filipe Leuch Bonfim UPINSIDE
 */
class Heranca {

    public $nome;
    public $idade;
    public $formacao;
    
    function __construct($nome, $idade) {
        $this->nome = $nome;
        $this->idade = $idade;
        $this->formacao = array();
    }
    
    public function envelhecer() {
        $this->idade ++;
    }
    
    public function formar($curso) {
        $this->formacao[] = (string) $curso;
    }
    
    public function verPessoa() {
        $formacao = implode(', ', $this->formacao);
        echo "{$this->nome} tem {$this->idade} anos de idade, e é formado em : {$formacao}.<hr>";
    }
}
