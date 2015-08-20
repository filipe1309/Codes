<?php

/**
 * <b>Update.class:</b> 
 * Classe responsável por atualizações genéricos no banco de dados!
 * @copyright (c) 2015, Filipe Leuch Bonfim UPINSIDE
 */
class Update extends Conn {

    private $tabela;
    private $dados;
    private $termos;
    private $places;
    private $result;

    /** @var PDOStatement */
    private $update;

    /** @var PDO */
    private $conn;

    public function exeUpdate($tabela, array $dados, $termos, $parseString) {
        $this->tabela = $tabela;
        $this->dados = $dados;
        $this->termos = (string) $termos;

        parse_str($parseString, $this->places);
        $this->getSyntax();
        $this->execute();
    }

    function getResult() {
        return $this->result;
    }

    public function getRowCount() {
        return $this->update->rowCount();
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
        $this->update = $this->conn->prepare($this->update);
    }

    /**
     * Monta a Query a partir do array (dados) informado
     */
    private function getSyntax() {
        foreach ($this->dados as $key => $value):
            $places[] = $key . ' = :' . $key;
        endforeach;

        $places = implode(', ', $places);
        $this->update = "UPDATE {$this->tabela} SET {$places} {$this->termos}";
    }

    /**
     * Executa a Query, e atribui o resultado na variável result
     */
    private function execute() {
        $this->connect();
        try {
            $this->update->execute(array_merge($this->dados, $this->places));
            $this->result = true;
        } catch (PDOException $e) {
            $this->result = null;
            wsErro("<b>Erro ao atualizar:</b> {$e->getMessage()}", $e->getCode());
        }
    }

}
