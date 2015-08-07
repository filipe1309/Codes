<?php

/**
 * AcessoProtegido.class [ TIPO ]
 * Descricao
 * @copyright (c) year, Filipe Leuch Bonfim UPINSIDE
 */
class AcessoProtegido {

   /*
    * Modificador protected
    * Atribui maior responsábilidade aos atributos e métodos
    * tem a segurança melhorada, e o compartilhamento se da apenas nas classes filhas,
    * e não como objeto  
    */
    
    public $nome;
    protected $email;

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
    
    /** pode ser utilizado, mas não alterado, nas classes filhas */
    final protected function setNome($nome) {
        $this->nome = $nome;
    }

}

/*
 * Nunca fazer isto (Colocar duas ou mais classes no mesmo arquivo), 
 * está assim apenas para simplificar o exemplo
 */
class AcessoProtegidoFilha extends AcessoProtegido {
    
    protected $CPF;
    
    /*public function setNome() {
        echo 'Consegui!';
    }*/
    
 public function addCPF($nome, $CPF) {
     parent::setNome($nome);
     $this->CPF = $CPF;
 }
}