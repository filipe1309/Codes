<?php

/**
 * MinhaSegundaClasse.class.php [ TIPO ]
 * Descricao
 * @copyright (c) year, Filipe Leuch Bonfim UPINSIDE
 */
class MinhaSegundaClasse extends MinhaClasse {
    public $idade;

    function getIdade() {
        return $this->idade;
    }

    function setIdade($idade) {
        $this->idade = $idade;
    }

}
