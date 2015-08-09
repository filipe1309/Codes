<?php

/**
 * ComposicaoUsuario.class [ TIPO ]
 * Descricao
 * @copyright (c) year, Filipe Leuch Bonfim UPINSIDE
 */
class ComposicaoUsuario {
    
    public $nome;
    public $email;
    private $endereco;
    
    function __construct($nome, $email) {
        $this->nome = $nome;
        $this->email = $email;
    }
    
    public function cadastrarEnderco($cidade, $estado) {
        $this->endereco = new ComposicaoEndereco($cidade, $estado);
    }
    
    /**
     * 
     * @return ComposicaoEndereco
     */
    function getEndereco() {
        return $this->endereco;
    }



}
