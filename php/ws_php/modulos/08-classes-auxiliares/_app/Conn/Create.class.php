<?php

/**
 * <b>Create.class:</b> 
 * Classe responsável por cadastros genéricos no banco de dados!
 * @copyright (c) 2015, Filipe Leuch Bonfim UPINSIDE
 */
class Create extends Conn {

    private $tabela;
    private $dados;
    private $result;
    
    /** @var PDOStatement */
    private $create;
    
    /** @var PDO */
    private $conn;
    
    /**
     * <b>exeCreate: </b> Executa um cadatro simplificado no banco de dados utilizando prepared statements.
     * Basta informar o nome da tabela e um array atribuitivo com o nome da coluna e valor!
     * 
     * @param STRING $tabela = Informe o nome da tabela no banco!
     * @param ARRAY $dados = Informe um array atribuitivo ( Nome da Coluna => Valor ).
     */
    public function exeCreate($tabela, array $dados) {
        $this->tabela = (string) $tabela;
        $this->dados = $dados;
        
        $this->getSyntax();
        $this->execute();
    }
    
    /**
     * <b>Obter resultado:</b> Reorna o ID do registro inserido ou false caso nenhum registro seja inserido!
     * @return INT = Retorna false, ou o último ID inserido na tabela (lasInsertId)
     */
    function getResult() {
        return $this->result;
    }

        
    /**
     * ****************************************
     * *********** PRIVATE METHODS ************
     * ****************************************
     */
    
    
    /**
     * Efetua a conexão com o banco de dados, obtendo o PDO, e
     * executa o método prepare do PDO, para realização dos binds
     */
    private function connect() {
        $this->conn = parent::getConn();
        $this->create = $this->conn->prepare($this->create);
    }
    
    /**
     * Monta a Query a partir do array (dados) informado, criando a sintaxe da query para o Prepared Statements
     */
    private function getSyntax() {
        $fields = implode(', ', array_keys($this->dados));
        $places = ':' . implode(', :', array_keys($this->dados));
        $this->create = "INSERT INTO {$this->tabela} ({$fields}) VALUES ({$places})";
    }
    
    /**
     * Executa a Query, e atribui o resultado na variável result
     */
    private function execute() {
        $this->connect();
        try {
       
            /** o método execute() do PDO, ao receber um array associativo
             *  associa(faz o bind) automaticamente as chaves com os nomes dos campos 
             * e os valores do arrays com os valores da tabela 
             */
            $this->create->execute($this->dados);
            $this->result = $this->conn->lastInsertId(); 
            
        } catch (PDOException $e) {
            $this->result = null;
            wsErro("<b>Erro ao cadastrar:</b> {$e->getMessage()}", $e->getCode());
            
        }
    }
}
