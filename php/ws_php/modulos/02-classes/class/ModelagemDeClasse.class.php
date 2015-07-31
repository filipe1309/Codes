<?php

/**
 * ModelagemDeClasse.class.php [ TIPO ]
 * Descricao
 * @copyright (c) year, Filipe Leuch Bonfim UPINSIDE
 */
class ModelagemDeClasse {

    public $nome;
    public $idade;
    public $profissao;
    public $contaSalario;
    
    function __construct($nome, $idade, $profissao, $contaSalario) {
        $this->nome = $nome;
        $this->idade = $idade;
        $this->profissao = $profissao;
        $this->contaSalario = $contaSalario;
    }
    
    public function trabalhar($trabalho, $valor) {
        $this->contaSalario += $valor;
        $this->darEcho("{$this->nome} desenvolveu um {$trabalho} e recebeu {$this->toReal($valor)}");
    }
    
    function setNome($nome) {
        $this->nome = $nome;
    }

    function setIdade($idade) {
        $this->idade = $idade;
    }

    function setProfissao($profissao) {
        $this->profissao = $profissao;
    }

    function setContaSalario($contaSalario) {
        $this->contaSalario = $contaSalario;
    }

    public function toReal($valor) {
        return number_format($valor, '2', '.', ',');
    }
    
    public function darEcho($mensagem) {
        echo "<p>{$mensagem}</p>";
    }

}
