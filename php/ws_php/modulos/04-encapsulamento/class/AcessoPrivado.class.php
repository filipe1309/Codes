<?php

/**
 * AcessoPrivado.class [ TIPO ]
 * Descricao
 * @copyright (c) year, Filipe Leuch Bonfim UPINSIDE
 */
class AcessoPrivado {
    /*
     * Modificador private
     * Responsabilidade total sobre os atributos, somente a classe pode acessar 
     * o atributo/método
     * é o mais seguro =)
     * Da mais trabalho =(
     */

    private $nome;
    private $email;
    private $CPF;

    function __construct($nome, $email, $CPF) {
        $this->setNome($nome);
        $this->setEmail($email);
        $this->setCPF($CPF);
    }

    public function setNome($nome) {
        if ($nome && is_string($nome)):
            $this->nome = $nome;
        else:
            die('Erro no nome!');
        endif;
    }

    public function setEmail($email) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)):
            $this->email = $email;
        else:
            die('Erro no email!');
        endif;
    }

    public function setCPF($CPF) {
        if (preg_match('/[0-9]*/i', $CPF) && strlen($CPF) == 11):
            $this->CPF = $CPF;
        else:
            die('Erro no CPF');
        endif;
    }

}
