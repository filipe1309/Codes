<?php

/**
 * AcessoPublico.class [ TIPO ]
 * Descricao
 * @copyright (c) year, Filipe Leuch Bonfim UPINSIDE
 */
class AcessoPublico {
    /*
    * Modificador public
    * Vantagem: facilidade na alteração
    * Devantagem: Erros na manipulação podem ocorrer com mais facilidade,
    * pois nenhuma verificação é feita na atribuição direta
    */
    
    public $nome;
    public $email;

    function __construct($nome, $email) {
        $this->nome = $nome;
        $this->setEmail($email);
    }

    function setEmail($email) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)):
            die('Email inválido!');
        else:
            $this->email = $email;
        endif;
    }

}
