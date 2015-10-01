<?php

/**
 * <b>Read.class:</b> 
 * Classe responsável por leituras genéricos no banco de dados!
 * @copyright (c) 2015, Filipe Leuch Bonfim UPINSIDE
 */
class Read extends Conn {

    private $select;
    private $places;
    private $result;

    /** @var PDOStatement */
    private $read;

    /** @var PDO */
    private $conn;

    public function exeRead($tabela, $termos = null, $parseString = null) {
        if (!empty($parseString)):
            $this->places = $parseString;
            /** Transforma string 'parcial' em array. Ex: name=firefox&views=10 → [‘name’ => ‘firefox’, ‘views’ => 10],
             * e armazena em $this->places
             */
            parse_str($parseString, $this->places);
        endif;

        $this->select = "SELECT * FROM {$tabela} {$termos}";
        $this->execute();
    }

    function getResult() {
        return $this->result;
    }

    public function getRowCount() {
        return $this->read->rowCount();
    }

    public function fullRead($query, $parseString = null) {

        $this->select = (string) $query;

        if (!empty($parseString)):
            $this->places = $parseString;
            /** Transforma string 'parcial' em array. Ex: name=firefox&views=10 → [‘name’ => ‘firefox’, ‘views’ => 10],
             * e armazena em $this->places
             */
            parse_str($parseString, $this->places);
        endif;

        $this->execute();
    }

    public function setPlaces($parseString) {
        parse_str($parseString, $this->places);
        $this->execute();
    }

    /**
     * ****************************************
     * *********** PRIVATE METHODS ************
     * ****************************************
     */

    /**
     * Efetua a conexão com o banco de dados, e
     * executa o método prepare do PDO, para realização dos binds
     */
    private function connect() {
        $this->conn = parent::getConn();
        $this->read = $this->conn->prepare($this->select);
        $this->read->setFetchMode(PDO::FETCH_ASSOC);
    }

    /**
     * Monta a Query a partir do array (dados) informado
     */
    private function getSyntax() {
        if ($this->places):
            foreach ($this->places as $vinculo => $valor):
                if ($vinculo == 'limit' || $vinculo == 'offset'):
                    $valor = (int) $valor;
                endif;
                $this->read->bindValue(":{$vinculo}", $valor, ( is_int($valor) ? PDO::PARAM_INT : PDO::PARAM_STR));
            endforeach;
        endif;
    }

    /**
     * Executa a Query, e atribui o resultado na variável result
     */
    private function execute() {
        $this->connect();
        try {
            $this->getSyntax();
            $this->read->execute();
            $this->result = $this->read->fetchAll();
        } catch (PDOException $e) {
            $this->result = null;
            wsErro("<b>Erro ao ler:</b> {$e->getMessage()}", $e->getCode());
        }
    }

}
