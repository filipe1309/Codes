<?php

/**
 * AtributosMetodos.class.php [ TIPO ]
 * Descricao
 * @copyright (c) year, Filipe Leuch Bonfim UPINSIDE
 */
class AtributosMetodos {

    var $nome;
    var $idade;
    var $profissao;

    function getUsuario() {
        return "{$this->nome} tem {$this->idade} anos de idade. E trabalha como {$this->profissao}";
    }

    function setUsuario($nome, $idade, $profissao) {
        $this->nome = $nome;
        $this->profissao = $profissao;
        $this->setIdade($idade);
    }

    function getClasse() {
        echo '<pre>';
        print_r($this);
        echo '</pre>';
    }

    function setIdade($idade) {
        if (!is_int($idade)):
            die('Idade informada é incorreta');
        else:
            $this->idade = $idade;
        endif;
    }

    function envelhecer() {
        $this->idade++;
    }
}
