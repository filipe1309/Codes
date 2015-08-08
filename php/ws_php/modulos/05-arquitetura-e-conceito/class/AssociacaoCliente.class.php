<?php

/**
 * AssociacaoClente.class [ TIPO ]
 * Descricao
 * @copyright (c) year, Filipe Leuch Bonfim UPINSIDE
 */
class AssociacaoCliente {

    private $cliente;
    private $nome;
    private $email;
    
    function __construct($nome, $email) {
        $this->cliente = md5($nome);
        $this->nome = $nome;
        $this->email = $email;
    }
    
    function getNome() {
        return $this->nome;
    }

    function getEmail() {
        return $this->email;
    }
    
    function getCliente() {
        return $this->cliente;
    }
    
}
