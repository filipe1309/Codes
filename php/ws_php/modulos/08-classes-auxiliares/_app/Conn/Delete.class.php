<?php

/**
 * <b>Delete.class:</b> 
 * Classe responsável por deletar genéricamente no banco de dados!
 * @copyright (c) 2015, Filipe Leuch Bonfim UPINSIDE
 */
class Delete extends Conn {

    private $tabela;
    private $termos;
    private $places;
    private $result;

    /** @var PDOStatement */
    private $delete;

    /** @var PDO */
    private $conn;

    public function exeDelete($tabela, $termos, $parseString) {
        $this->tabela = (string) $tabela;
        $this->termos = (string) $termos;

        parse_str($parseString, $this->places);
        $this->getSyntax();
        $this->execute();
    }

    function getResult() {
        return $this->result;
    }

    public function getRowCount() {
        return $this->delete->rowCount();
    }

    public function setPlaces($parseString) {
        parse_str($parseString, $this->places);
        $this->getSyntax();
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
        $this->delete = $this->conn->prepare($this->delete);
    }

    /**
     * Monta a Query a partir do array (dados) informado
     */
    private function getSyntax() {
        $this->delete = "DELETE FROM {$this->tabela} {$this->termos}";
    }

    /**
     * Executa a Query, e atribui o resultado na variável result
     */
    private function execute() {
        $this->connect();
        try {
            $this->delete->execute($this->places);
            $this->result = true;
        } catch (PDOException $e) {
            $this->result = null;
            wsErro("<b>Erro ao deletar:</b> {$e->getMessage()}", $e->getCode());
        }
    }

}
