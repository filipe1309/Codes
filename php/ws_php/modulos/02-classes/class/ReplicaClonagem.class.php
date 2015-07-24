<?php

/**
 * ReplicaClonagem.class.php [ TIPO ]
 * Descricao
 * @copyright (c) year, Filipe Leuch Bonfim UPINSIDE
 */
class ReplicaClonagem {

    var $tabela;
    var $termos;
    var $addQuery;
    var $query;

    function __construct($tabela, $termos, $addQuery) {
        $this->tabela = $tabela;
        $this->termos = $termos;
        $this->addQuery = $addQuery;
    }

    function setTabela($tabela) {
        $this->tabela = $tabela;
    }
    
    function setTermos($termos) {
        $this->termos = $termos;
    }

    function ler() {
        $this->query = "SELECT * FROM {$this->tabela} WHERE {$this->termos} {$this->addQuery}";
        echo "{$this->query}<hr>";
    }

}
