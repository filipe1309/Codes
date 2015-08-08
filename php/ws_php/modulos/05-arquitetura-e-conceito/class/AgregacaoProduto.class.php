<?php

/**
 * AgregacaoProduto [ TIPO ]
 * Descricao
 * @copyright (c) year, Filipe Leuch Bonfim UPINSIDE
 */
class AgregacaoProduto {

    private $produto;
    private $nome;
    private $valor;
    
    function __construct($produto, $nome, $valor) {
        $this->produto = $produto;
        $this->nome = $nome;
        $this->valor = $valor;
    }
    

    function getProduto() {
        return $this->produto;
    }

    function getNome() {
        return $this->nome;
    }

    function getValor() {
        return $this->valor;
    }

}
