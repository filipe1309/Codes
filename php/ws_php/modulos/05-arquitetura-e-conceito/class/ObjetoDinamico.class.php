<?php

/**
 * ObjetoDinamico.class [ TIPO ]
 * Descricao
 * @copyright (c) year, Filipe Leuch Bonfim UPINSIDE
 */
class ObjetoDinamico {

    public $nome;
    private $email;

    public function novo($cliente) {
        if (is_object($cliente)):
            $this->nome = $cliente->nome;
            $this->email = $cliente->email;
        else:
            die('Erro, informe um obejto com nome e e-mail!');
        endif;
    }

}
