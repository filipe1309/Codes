<?php

/**
 * ClassesObjetos.class.php [ TIPO ]
 * Descricao
 * @copyright (c) year, Filipe Leuch Bonfim UPINSIDE
 */
class ClassesObjetos {

    var $Classe;
    var $Funcao;
    
    function getClass($Class, $Funcao) {
        echo "<p> A classe {$Class} serve para {$Funcao}";
    }
    
    function verClass() {
        echo '<pre>';
        print_r($this);
        echo '</pre>';
    }
}
